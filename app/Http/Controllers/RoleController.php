<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function show($slug)
    {
        $role = Role::with('users')->where('slug', $slug)->first();
        $users = $role->users()->latest()->paginate(10);
        return view('user.index', compact('users', 'role'));
    }
}
