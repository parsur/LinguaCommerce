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
    public $admin = '\App\Models\User';

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

    // Get Admin
    public function adminTable(AdminDataTable $dataTable) {
        return $dataTable->render('admin.adminList');
    }

    // Store Admin
    public function store(StoreAdminRequest $request,SuccessMessages $message) {

        // Insert
        if($request->get('button_action') == "insert") {
            $this->addAdmin($request);
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == 'update') {
            $this->addAdmin($request);
            $success_output = $message->getUpdate();
        }

        $output = array('success' => $success_output);

        return json_encode($output);
    }

    // Add Or Update Admin
    public function addAdmin($request) {
        // Edit
        $admin = User::find($request->get('id'));
        if(!$admin) {
            // Insert
            $admin = new User();
        }
        $admin->name = $request->get('name');
        $admin->email = $request->get('email');
        $admin->role = 'admin';

        if($request->get('password') != 'رمز عبور جدید' and $request->get('password') != 'تکرار رمز عبور جدید')
            $admin->password = Hash::make($request->get('password'));

        $admin->save();
    }
    // Delete Each Admin
    public function delete(Action $action, $id) {
        return $action->delete($this->admin,$id);
    }

    // Edit Data
    public function edit(Action $action,Request $request) {
        return $action->edit($this->admin,$request->get('id'));
    }
}
