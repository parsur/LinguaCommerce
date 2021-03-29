<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Providers\Action;
use App\Providers\SuccessMessages;
use App\Providers\StoreConsultationRequest;
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
            if($request->get('description')) {
                
                $consultation = Consultation::create(['user_id' => auth()->user()->id]);
                $consultation->descriptions->create(['description' => $request->get('description')]);

            } else if($request->get('phone_number')) {
                Consultation::create(['phone_number' => $request->get('phone_number')]);
            }

            DB::commit();
            return response()->json('درخواست مشاوره با موفقیت ثبت شد', JSON_UNESCAPED_UNICODE);

        } catch(Exception $e) {
            throw $e;
            DB::rollBack();
        }
    }
}
