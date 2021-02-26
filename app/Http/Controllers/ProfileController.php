<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\Action;
use App\Models\User;

class ProfileController extends Controller
{
    // Profile
    public function index() {

        $users = User::where('role', User::USER)->get();
        return response()->json($users);
    }

    // Edit
    public function edit(Request $request,Action $action) {
        $action->edit(User::class, $request->get('id'));
    }

    // Delete 
    public function delete(Action $action, $id) {
        return $action->delete(User::class,$id);
    }
}
