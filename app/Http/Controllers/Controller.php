<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Json response with success
    public function responseWithSuccess($data, $status = Response::HTTP_CREATED) {
        return response()->json(['success' => $data], $status);
    }

    // Json response with error
    public function responseWithError($data, $status = Response::HTTP_BAD_REQUEST) {
        return response()->json(['error' => $data], $status);
    }

    // Get success message
    public function getInsertionMessage() {
        return '<div class="alert alert-success">اطلاعات با موفقیت ثبت شد</div>';
    }

    // Get error message
    public function getUpdateMessage() {
        return '<div class="alert alert-success">اطلاعات با موفقیت ویرایش شد</div>';
    }
}
