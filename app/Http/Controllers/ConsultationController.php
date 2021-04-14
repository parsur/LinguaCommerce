<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Description;
use App\Providers\Action;
use App\Providers\SuccessMessages;
use App\Http\Requests\StoreConsultationRequest;
use App\DataTables\ConsultationDataTable;
use Illuminate\Http\Request;
use DB;

class ConsultationController extends Controller
{
    // Datatable To blade
    public function list() {
        // dataTable
        $dataTable = new ConsultationDataTable();

        // Order table
        $vars["consultationTable"] = $dataTable->html();

        return view('consultation.list', $vars);
    }

    // Get order
    public function consultationTable(ConsultationDataTable $dataTable) {
        return $dataTable->render('consultation.list');
    }

    // Details
    public function details(Request $request) {
        $vars['consultation'] = Consultation::find($request->get('id'));
        return view('consultation.details', $vars);
    }

    // delete
    public function delete(Action $action,$id) {
        return $action->delete(Order::class, $id);
    }

    // Submit final order
    public function store(StoreConsultationRequest $request) {

        DB::beginTransaction();
        try {
            if($request->has('description')) {
                
                $consultation = Consultation::create(['user_id' => auth('sanctum')->user()->id]);
                $consultation->description()->create(['description' => $request->get('description')]);

            } else if($request->has('phone_number')) {
                Consultation::create(['phone_number' => $request->get('phone_number')]);
            }

            DB::commit();
            return response()->json(['success' => 'درخواست مشاوره با موفقیت ثبت شد'], 200) ; // JSON_UNESCAPED_UNICODE

        } catch(Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }
}
