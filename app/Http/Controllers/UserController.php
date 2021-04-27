<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\StoreLoginRequest;
use App\DataTables\UserDataTable;
use App\Providers\Action;
use App\Models\User;
use App\Models\Media;
use Carbon\Carbon;
use Morilog\Jalali\Jalalian;
use File;
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
    public function store(StoreUserRequest $request, $role = User::USER) {
        // Id
        $id = $request->get('id');

        User::updateOrCreate(
            ['id' => $id],
            ['name' => $request->get('name'),'email' => $request->get('email'),
            'role' => $role,'password' => Hash::make($request->get('password')),
            'phone_number' => $request->get('phone_number')]
        );

        // Image
        if($request->has('images')) {

            $action = new Action();

            $imageUploader = Media::where('media_id', $id)->where('media_type', User::class)->first();
            $action->image($imageUploader, $request, $id, User::class);
        }

        return $this->getAction($request->get('button_action'));
    }
    
    // Edit Data
    public function edit(Action $action,Request $request) {
        return $action->edit(User::class, $request->get('id'));
    }
    
    // Delete
    public function delete(Action $action, $id) {
        return $action->delete(User::class,$id);
    }

}
