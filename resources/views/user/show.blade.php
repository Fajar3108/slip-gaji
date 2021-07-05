@extends('layouts.app')

@section('content')
<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row">
            <div class="col-xl-4 col-md-12 d-table mt-3">
                <div class="d-table-cell">
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Nama</th>
                                    <td><p class="text-break m-0">{{ $user->name }}</p></td>
                                </tr>
                                <tr>
                                    <th>Posisi</th>
                                    <td><p class="text-break m-0">{{ $user->role->name }}</p></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><p class="text-break m-0">{{ $user->email }}</p></td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td><p class="text-break m-0">{{ $user->nik }}</p></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-md-12 d-table mt-3">
                <div class="d-table-cell">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <select name="month" id="month" class="form-select" onchange="window.location.href=this.value">
                                    <option value="">Year</option>
                                    <?php
                                        $currentYear = date('Y');
                                        $selectedYear = request()->year;
                                        if (isset($salaries[0])) {
                                            $selectedYear = date('Y', strtotime($salaries[0]->date));
                                        }
                                        foreach (range(2020, $currentYear) as $value) {
                                            if($value == $selectedYear) {
                                                echo '<option selected value=?year='. $value . '>' . $value . '</option>';
                                            } else {
                                                echo '<option value=?year='. $value . '>' . $value . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Total Pendapatan Kotor</th>
                                        <th>Total Potongan</th>
                                        <th>Total Gaji</th>
                                        <th>Bulan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($salaries) <= 0)
                                    <tr><td colspan="5" class="h2 p-4 text-center m-0">Not Found</td></tr>
                                    @endif
                                    @foreach ($salaries as $salary)
                                    <tr>
                                        <td>{{ $salary->no }}</td>
                                        <td>Rp. {{ number_format($salary->total_pendapatan()) }}</td>
                                        <td>Rp. {{ number_format($salary->total_potongan()) }}</td>
                                        <td>Rp. {{ number_format($salary->total_pendapatan() - $salary->total_potongan()) }}</td>
                                        <td>{{ date('F', strtotime($salary->date)) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
