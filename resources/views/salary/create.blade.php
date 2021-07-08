@extends('layouts.app')

@section('content')
<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row">
            <div class="col-12 col-md-6 d-table mt-3">
                <div class="d-table-cell">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('salary.index') }}"><- Back</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('salary.store') }}" method="POST" id="input-form">
                                @include('salary.partials.form')

                                <button class="btn btn-primary mt-3 w-100">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 d-table mt-3">
                @include('salary.partials.preview-gaji')
            </div>
        </div>
    </div>
</main>
@endsection

@section('custom-scripts')
    <script>
    // Select 2 | User Search
    $(document).ready(function() {
        $('#userSearch').select2();
    });
    </script>
    <script src="{{ asset('js/scripts/salary/create.js') }}" type="module"></script>
@endsection

