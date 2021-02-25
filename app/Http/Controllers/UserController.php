<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAdminRequest;
use App\Providers\SuccessMessages;
use App\Providers\EnglishConvertion;
use App\DataTables\UserDataTable;
use App\Providers\Action;
use App\Models\User;
use Hash;


class UserController extends Controller
{
    // User Dashboard
    public function index() {
        return view('user.userHome');
    }

    // DataTable to blade
    public function list() {
        // dataTable
        $dataTable = new UserDataTable();

        // User Table
        $vars['userTable'] = $dataTable->html();

        return view('user.list', $vars);
    }

    // Get user
    public function userTable(UserDataTable $dataTable) {
        return $dataTable->render('user.list');
    }

    // Store user
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

        $englishConvertion = new EnglishConvertion();

        if($request->get('password') != 'رمز عبور جدید' and $request->get('password') != 'تکرار رمز عبور جدید') {
            $user = User::find($request->get('id'));
            if(!$user) {
                $user = new User();
            }
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->role = 'user';
            $user->password = Hash::make($request->get('password'));
            if($request->get('phone_number'))
                $user->phone_number = $englishConvertion->convert($request->get('phone_number'));
            
            $user->save();
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
