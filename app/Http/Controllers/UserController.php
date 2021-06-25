<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\{Role, User};
use Illuminate\Support\Str;
use Throwable;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('user.index', compact('users'));
    }

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

    public function search()
    {
        $keyword = request()->keyword;

        if (!$keyword) return back();

        $users = User::where('name', 'LIKE', '%' . $keyword . '%')->orWhere('email', 'LIKE', '%' . $keyword . '%')->orWhere('nik', 'LIKE', '%' . $keyword . '%')->latest()->paginate(10);

        return view('user.index', compact('users'));
    }

    public function store(UserRequest $request)
    {
        $role = Role::firstOrCreate(
            ['slug' => Str::slug($request->role)],
            ['name' => $request->role]
        );

        $role->users()->create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);

        return back();
    }

    public function update(User $user, UserRequest $request)
    {
        $role = Role::firstOrCreate(
            ['slug' => Str::slug($request->role)],
            ['name' => $request->role]
        );

        $user->update([
            'role_id' => $role->id,
            'name' => $request->name,
            'nik' => $request->nik,
            'email' => $request->email,
        ]);

        return back();
    }
}
