<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Salary;
use PDF;
use App\Http\Resources\SalaryResource;

class SalaryController extends Controller
{
    public function show(Request $request)
    {
        $salaries = $request->user()->salaries;

        foreach ($salaries as $salary) {
            $salary_date = Carbon::createFromFormat('Y-m-d', $salary->date);
            if ($salary_date->format('Y') == $request->year && $salary_date->format('m') == $request->month) {
                return new SalaryResource($salary);
            }
        }

        return response()->json([
            'message' => 'Not Found'
        ], 404);
    }

    public function print_pdf(Salary $salary)
    {
        $pdf = PDF::loadview('salary/pdf', ['salary' => $salary]);

        return $pdf->stream('SlipGaji.pdf');
    }
}
