<?php

namespace App\Http\Controllers;

use App\Imports\SalariesImport;
use App\Models\Salary;
use Maatwebsite\Excel\Facades\Excel;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::latest()->paginate(10);
        return view('salary.index', compact('salaries'));
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

        return back();
    }
}
