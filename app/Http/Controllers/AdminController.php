<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\DataTables\UserDataTable;
use App\DataTables\AdminDataTable;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Providers\SuccessMessages;
use App\Providers\Action;
use App\Models\User;

class AdminController extends Controller
{
    // Admin Home
    public function admin() {
        return view('admin.home');
    }

    // DataTable to blade
    public function list() {
        // dataTable
        $dataTable = new AdminDataTable();

        // Admin Table
        $vars['adminTable'] = $dataTable->html();

        return view('admin.list', $vars);
    }

    // Get admin
    public function adminTable(AdminDataTable $dataTable) {
        return $dataTable->render('admin.list');
    }

    // Store Admin
    public function store(StoreUserRequest $request,SuccessMessages $message,UserController $userController) {
        
        $userController->add($request, User::ADMIN);

        // Insert
        if($request->get('button_action') == "insert") {
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == 'update') {
            $success_output = $message->getUpdate();
        }

        return response()->json(['success' => $success_output]);
    }

    
    // Delete Each Admin
    public function delete(Action $action, $id) {
        return $action->delete(User::class,$id);
    }

    // Edit Data
    public function edit(Action $action,Request $request) {
        return $action->edit(User::class,$request->get('id'));
    }
}
