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
    // User Dashboard(profile)
    public function show() {
        $users = User::where('id', 32)->where('role', User::USER)->get();
        return response()->json($users);
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

        $this->add($request);

        // Insert
        if($request->get('button_action') == "insert") {
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == 'update') {
            $success_output = $message->getUpdate();
        }

        $output = array('success' => $success_output);

        return json_encode($output);
    }

    // Add or update user
    public function add($request) {
        User::updateOrCreate(
            ['id' => $request->get('id')],
            ['name' => $request->get('name'),'email' => $request->get('email'),
            'role' => User::USER,'password' => Hash::make($request->get('password')),
            'phone_number' => $request->get('phone_number')]
        );
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
