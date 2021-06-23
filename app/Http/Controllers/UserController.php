<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\ViewName;
use Throwable;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function profile()
    {
        return view('auth.profile');
    }

    public function destroy($id)
    {
        try{
            User::find($id)->delete();
            toast('User deleted successfuly', 'success');

            return back();
        } catch(Throwable $e) {
            toast($e, 'error');
            return back();
        }
    }

    public function search(Role $role)
    {
        $keyword = request()->keyword;


        // $role = Role::where('slug', $slug)->first();
        if (!$keyword) return back();

        $users = $role->users()->where('name', 'LIKE', '%' . $keyword . '%')->orWhere('email', 'LIKE', '%' . $keyword . '%')->latest()->paginate(10);

        // $users = User::with('role')->whereHas('role', function($query) use ($slug){
        //     $query->where('slug', $slug);
        // })->where('name', 'LIKE', '%' . $keyword . '%')->orWhere('email', 'LIKE', '%' . $keyword . '%')->latest()->paginate(10);

        return view('user.index', compact('users', 'role'));
    }

    public function store(Role $role, UserRequest $request)
    {
        $role->users()->create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);

        return back();
    }

    public function update(User $user, UserRequest $request)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
        ]);

        return back();
    }
}
