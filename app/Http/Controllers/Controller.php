<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Get action
    public function getAction($action) {
        // Insert
        if($action == 'insert') {
            $success_output = $this->getInsertionMessage();
        }
        
        // Update
        if($action == 'update') {
            $success_output = $this->getUpdateMessage();
        }

        return $this->successfulResponse($success_output);
    }

    // Get success message
    public function getInsertionMessage() {
        return '<div class="alert alert-success">اطلاعات با موفقیت ثبت شد</div>';
    }

    // Get update message
    public function getUpdateMessage() {
        return '<div class="alert alert-success">اطلاعات با موفقیت ویرایش شد</div>';
    }

    // Json response with success
    public function successfulResponse($data, $status = Response::HTTP_CREATED) {
        return response()->json(['success' => true, 'message' => $data], $status);
    }

    // Json response with error
    public function failedResponse($data, $status = Response::HTTP_BAD_REQUEST) {
        return response()->json(['success' => false, 'message' => $data], $status);
    }
}
