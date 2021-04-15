<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\StoreLoginRequest;
use App\Providers\SuccessMessages;
use App\Providers\EnglishConvertion;
use App\DataTables\UserDataTable;
use App\Providers\Action;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;

class UserController extends Controller
{
    // User Dashboard(profile)
    public function show() {

        $vars['user'] = User::where('id', Auth::user()->id)->first();
        
        return response()->json($vars);
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
    public function store(StoreUserRequest $request,SuccessMessages $message) {

        $this->add($request, User::USER);

        // Insert
        if($request->get('button_action') == 'insert') {
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == 'update') {
            $success_output = $message->getUpdate();
        }

        return $this->responseWithSuccess($success_output);
    }

    // Add or update user
    public function add($request,$role) {

        User::updateOrCreate(
            ['id' => $request->get('id')],
            ['name' => $request->get('name'),'email' => $request->get('email'),
            'role' => $role,'password' => Hash::make($request->get('password')),
            'phone_number' => $request->get('phone_number')]
        );
    }

    
    // Edit Data
    public function edit(Action $action,Request $request) {
        return $action->edit(User::class,$request->get('id'));
    }
    
    // Delete
    public function delete(Action $action, $id) {
        return $action->delete(User::class,$id);
    }

}
