<?php

namespace App\Http\Controllers;
use App\DataTables\AdminDataTable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAdminRequest;
use App\Providers\Action;
use App\Providers\SuccessMessages;
use App\Models\Cat;
use App\Models\User;
use File;

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

        if($request->get('password') != 'رمز عبور جدید' and $request->get('password') != 'تکرار رمز عبور جدید') {
            $password = Hash::make($request->get('password'));
            User::updateOrCreate(
                ['id' => $request->get('id')],
                ['name' => $request->get('name'), 'email' => $request->get('email'), 'role' => 'admin', 'password' => $password]
            );
        }
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
