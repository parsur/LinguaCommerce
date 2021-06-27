<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use App\DataTables\UserDataTable;
use App\DataTables\AdminDataTable;
use App\Http\Requests\StoreUserRequest;
use App\Providers\Action;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        // Admin table
        $vars['adminTable'] = $dataTable->html();

        return view('admin.list', $vars);
    }

    // Get admin
    public function adminTable(AdminDataTable $dataTable) {
        return $dataTable->render('admin.list');
    }

    // Store admin
    public function store(StoreUserRequest $request,UserController $userController) {
        $userController->store($request, User::ADMIN);

        return $this->getAction($request->get('button_action'));
    }

    
    // Delete
    public function delete(Action $action, $id) {
        return $action->delete(User::class,$id);
    }

    // Edit Data
    public function edit(Action $action,Request $request) {
        return $action->edit(User::class,$request->get('id'));
    }
}
