<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\{Role, User};
use Illuminate\Support\Str;
use Throwable;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        $roles = Role::all();

        return view('user.index', compact('users', 'roles'));
    }

    public function show(User $user)
    {
        $salaries = [];

        $year = now()->format('Y');

        if (isset(request()->year)) {
            $year = request()->year;
        }

        foreach ($user->salaries()->orderBy('date', 'DESC')->get() as $salary) {
            $salary_date = Carbon::createFromFormat('Y-m-d', $salary->date);
            if ($salary_date->format('Y') == $year) {
                $salaries[] = $salary;
            }
        }

        return view('user.show', compact('user', 'salaries'));
    }

    public function profile()
    {
        return view('auth.profile');
    }

    public function destroy($id)
    {
        try{
            if (auth()->user()->id == $id) {
                Alert::error('Error', 'Tidak bisa hapus diri sendiri');
                return back();
            }

            $user = User::find($id);
            $user->salaries()->delete();
            $user->delete();

            Alert::success('success', 'User deleted successfuly');

            return back();
        } catch(Throwable $e) {
            dd($e);
            Alert::error('Error', $e);
            return back();
        }
    }

    public function search()
    {
        $keyword = request()->keyword;

        if (!$keyword) return back();

        $users = User::where('name', 'LIKE', '%' . $keyword . '%')->orWhere('email', 'LIKE', '%' . $keyword . '%')->orWhere('nik', 'LIKE', '%' . $keyword . '%')->latest()->paginate(10);
        $roles = Role::all();

        return view('user.index', compact('users', 'roles'));
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

        Alert::success('success', 'User created successfuly');

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

        Alert::success('success', 'User updated successfuly');

        return back();
    }

    public function import()
    {
        $this->validate(request(), [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

        $file = request()->file('file');
        $file_name = rand().$file->getClientOriginalName();
        $file->move('user_file', $file_name);

        Excel::import(new UsersImport, public_path('/user_file/'.$file_name));

        Alert::success('Success', 'Imported users successfuly');

        return back();
    }
}
