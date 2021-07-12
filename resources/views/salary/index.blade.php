@extends('layouts.app')

@section('content')

<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row">
            <div class="col-12 d-table mt-3">
                <div class="d-table-cell align-middle">
                    <div class="card">
                        <div class="card-header m-0 row">
                            <div class="col-6">
                                <a href="{{ route('salary.create') }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Create">
                                Create
                                </a>

                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importExcel" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Import">Import</button>

                                <button type="submit" class="btn btn-danger disabled" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete All Selected" onclick="deleteConfirm(event)" id="massDelete"><i data-feather="trash-2"></i></button>
                            </div>
                            <div class="col-6">
                                <form class="d-flex" action="">
                                    <input type="text" class="form-control" placeholder="search here.." id="searchUserInput" name="keyword">
                                    <button type="submit" class="btn btn-primary" id="searchButton">Search</button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover my-0" id="salariesTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th><input type="checkbox" id="selectAll" class="form-check-input"></th>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Total Pendapatan</th>
                                        <th>Total Potongan</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="dataSalaries">
                                    @if ($salaries->count() <= 0)
                                    <tr><td colspan="6" class="h2 p-4 text-center m-0">Not Found</td></tr>
                                    @endif
                                    @foreach ($salaries as $salary)
                                    <tr>
                                        <td><input type="checkbox" name="ids[]" class="form-check-input check-id"></td>
                                        <td>{{ $salary->no }}</td>
                                        <td><a href="{{ route('user.show', $salary->user->id) }}">{{ $salary->user->name }}</a></td>
                                        <td>Rp. {{ number_format($salary->total_pendapatan()) }}</td>
                                        <td>Rp. {{ number_format($salary->total_potongan()) }}</td>
                                        <td class="text-success"><strong>Rp. {{ number_format($salary->total_pendapatan() - $salary->total_potongan()) }}</strong></td>
                                        <td>
                                            <form action="{{ route('salary.destroy', $salary->id) }}" method="POST" class="d-flex">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('salary.pdf', $salary->id) }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Export PDF"><i data-feather="download"></i></a>

                                                <a href="{{ route('salary.edit', $salary->id) }}" class="btn btn-success mx-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i data-feather="edit"></i></a>

                                                <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" onclick="deleteConfirm(event)"><i data-feather="trash-2"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $salaries->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="importExcel" tabindex="-1" aria-labelledby="importExcelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('salary.import') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importExcelLabel">Import</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <label>Pilih file excel</label>
                        <div class="form-group">
                            <input type="file" name="file" required="required" class="form-control">
                            @error('file')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@section('custom-scripts')
    <script>
        const deleteConfirm = (event) => {
            const result = confirm('Are you sure');
            if (!result) event.preventDefault();
        }

        const selectAll = document.getElementById('selectAll');
        const massDeleteBtn = document.getElementById('massDelete');

        selectAll.onclick = () => {
            const checkboxes = document.querySelectorAll('.check-id');
            for (const checkbox of checkboxes) {
                checkbox.checked = selectAll.checked;
            }
        }

        const massDelete = (event) => {
            const result = confirm('Are you sure');
            if (!result) event.preventDefault();
        }

        const checkIds = () => {
            const ids = document.querySelectorAll('.check-id');
            for (const id of ids) {
                if (id.checked) {
                    massDeleteBtn.classList.remove('disabled');
                    return;
                }
            }
            massDeleteBtn.classList.add('disabled');
        }

        setInterval(() => {
            checkIds();
        }, 100)

    </script>
@endsection
