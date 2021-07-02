<?php

namespace App\Http\Controllers;

use App\Imports\SalariesImport;
use App\Models\{Salary, User};
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\SalaryRequest;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class SalaryController extends Controller
{
    public function index()
    {
        if (request()->has('keyword')) {
            $salaries = $this->search(request()->keyword);
        } else {
            $salaries = Salary::latest()->paginate(10);
        }
        return view('salary.index', compact('salaries'));
    }

    public function show(Salary $salary)
    {
        return view('salary.show', compact('salary'));
    }

    public function create()
    {
        return view('salary.create', [
            'salary' => new Salary()
        ]);
    }

    public function store(SalaryRequest $request)
    {
        $user = User::where('nik', $request->nik)->first();
        if (!$user) {
            Alert::error('Error', "Karyawan dengan nik {$request->nik} tidak ditemukan");
            return back();
        }
        $user->salaries()->create($request->all());
        Alert::success('Created', 'Deleted salary successfuly');

        return redirect()->route('salary.index');
    }

    public function edit(Salary $salary)
    {
        return view('salary.edit', compact('salary'));
    }

    public function update(Salary $salary, SalaryRequest $request)
    {
        $user = User::where('nik', $request->nik)->first();
        if (!$user) {
            Alert::error('Error', "Karyawan dengan nik {$request->nik} tidak ditemukan");
            return back();
        }

        $payload = $request->all();
        $payload["user_id"] = $user->id;

        $salary->update($payload);
        Alert::success('Success', 'Updated salary successfuly');

        return redirect()->route('salary.index');
    }

    public function destroy(Salary $salary)
    {
        $salary->delete();
        Alert::success('Success', 'Deleted salary successfuly');

        return back();
    }

    public function import()
    {
        $this->validate(request(), [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

        $file = request()->file('file');
        $file_name = rand().$file->getClientOriginalName();
        $file->move('salary_file', $file_name);

        Excel::import(new SalariesImport, public_path('/salary_file/'.$file_name));

        Alert::success('Success', 'Imported salary successfuly');

        return back();
    }

    public function search($keyword)
    {
        $salaries = Salary::where('no', 'LIKE', '%' . $keyword . '%')
        ->orWhereHas('user', function($query) use ($keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%')->orWhere('email', 'LIKE', '%' . $keyword . '%')->orWhere('nik', 'LIKE', '%' . $keyword . '%');
        })
        ->latest()->paginate(10);

        return $salaries;
    }

    public function print_pdf(Salary $salary)
    {
        $pdf = PDF::loadview('salary/pdf', ['salary' => $salary]);

        return $pdf->stream('slip-gaji');
    }
}
