<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use App\DataTables\UserDataTable;
use App\DataTables\AdminDataTable;
use App\Http\Requests\StoreUserRequest;
use App\Providers\Action;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public $action;

    public function __construct() {
        $this->action = new Action();
    }
    
    // Admin page
    public function admin() {
        return view('admin.home');
    }

    // Datatable to blade
    public function list() {

        $dataTable = new AdminDataTable();

        // Admin table
        $vars['adminTable'] = $dataTable->html();

        return view('admin.list', $vars);
    }

    // Get 
    public function adminTable(AdminDataTable $dataTable) {
        return $dataTable->render('admin.list');
    }

    // Store
    public function store(StoreUserRequest $request, UserController $userController) {
        $userController->store($request, User::ADMIN);

        return $this->getAction($request->get('button_action'));
    }

    // Edit D
    public function edit(Request $request) {
        return $this->action->edit(User::class,$request->get('id'));
    }
    
    // Delete
    public function delete($id) {
        return $this->action->delete(User::class,$id);
    }
}
