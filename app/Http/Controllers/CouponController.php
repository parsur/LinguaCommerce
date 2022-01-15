<?php

namespace App\Http\Controllers;

use App\DataTables\CouponDataTable;
use App\Http\Requests\StoreCouponRequest;
use App\Providers\Action;
use App\Models\Coupon;
use App\Models\Course;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;

class CouponController extends Controller
{
    public $action;

    public function __construct() {
        $this->action = new Action();
    }

    // Datatable to blade
    public function list() {
        // dataTable
        $dataTable = new CouponDataTable();

        // Coupon table
        $vars['couponTable'] = $dataTable->html();
        // Carts
        $vars['courses'] = Course::select('id','name')->get();

        return view('couponList', $vars);
    }

    // Get coupon
    public function couponTable(CouponDataTable $dataTable) {
        return $dataTable->render('couponList');
    }

    // Store 
    public function store(StoreCouponRequest $request) { 
         
        DB::transaction(function() use($request) {

            $id = $request->get('id'); 

            foreach($request->get('courses') as $course) {
                // Store
                $coupon = Coupon::updateOrCreate(
                    ['id' => $id],  
                    ['code' => $request->get('coupon_code'), 'value' => $request->get('value'), 
                    'type' => $request->get('type'), 'course_id' => $course]
                );

                // Status
                $coupon->statuses()->updateOrCreate(
                    ['status_id' => $id],
                    ['status' => $request->get('status'), 'status_type' => Coupon::class]
                );
            }
        });

        return $this->getAction($request->get('button_action'));
    }

    // Activate coupon 
    public function activate(Request $request) {

        $coupon = Coupon::where('code', $request->get('coupon_code'))->whereIn('course_id', $request->get('course_id'))
                        ->select('code')->whereHas('statuses', function($query) {
                            $query->active();
                        })->get();

        if(!$coupon) {
            return $this->failedResponse('متاسفانه کد تخفیف یافت نشد، لطفا دوباره امتحان کنید');
        }

        return response()->json(['message' => 'کد تخفیف با موفقیت فعال شد', 'code' => $coupon], Response::HTTP_CREATED);
    }

    // Edit 
    public function edit(Request $request) {
        return $this->action->edit(Coupon::class, $request->get('id'));
    }
    
    // Delete
    public function delete($id) {
        return $this->action->delete(Coupon::class,$id);
    }

}
