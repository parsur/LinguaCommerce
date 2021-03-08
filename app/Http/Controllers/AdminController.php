<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\DataTables\AdminDataTable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAdminRequest;
use App\Providers\SuccessMessages;
use App\Providers\Action;
use App\Models\User;

class AdminController extends Controller
{

    // Admin Home
    public function admin() {
        return view('admin.adminHome');
    }

    // DataTable to blade
    public function list() {
        // dataTable
        $dataTable = new AdminDataTable();

        // Admin Table
        $vars['adminTable'] = $dataTable->html();

        return view('admin.adminList', $vars);
    }

    // Get admin
    public function adminTable(AdminDataTable $dataTable) {
        return $dataTable->render('admin.adminList');
    }

    // Store Admin
    public function store(StoreAdminRequest $request,SuccessMessages $message) {

        // Insert
        if($request->get('button_action') == "insert") {
            $this->add($request);
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == 'update') {
            $this->add($request);
            $success_output = $message->getUpdate();
        }

        $output = array('success' => $success_output);

        return json_encode($output);
    }

    // Add or update user
    public function add($request) {
        $user = User::find($request->get('id'));
        if(!$user) {
            $user = new User();
        }
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->role = User::ADMIN;
        $user->password = Hash::make($request->get('password'));
        if($request->get('phone_number'))
            $user->phone_number = $request->get('phone_number');
        
        $user->save();
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
