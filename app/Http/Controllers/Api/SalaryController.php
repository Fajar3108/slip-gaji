<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function show(Request $request)
    {
        $salaries = $request->user()->salaries;

        foreach ($salaries as $salary) {
            $salary_date = Carbon::createFromFormat('Y-m-d', $salary->date);
            if ($salary_date->format('Y') == $request->year && $salary_date->format('m') == $request->month) {
                return response()->json($salary);
            }
        }

        return response()->json([
            'message' => 'Not Found'
        ], 404);
    }
}
