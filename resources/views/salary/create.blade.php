@extends('layouts.app')

@section('content')
<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row">
            <div class="col-12 col-md-6 d-table mt-3">
                <div class="d-table-cell">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('salary.store') }}" method="POST">
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
    const gajiPokok = document.getElementById('gajiPokok');
    console.log(gajiPokok.innerHTML);
</script>
{{-- <script>
document.addEventListener("DOMContentLoaded", function() {
    var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
    var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
    document.getElementById("datetimepicker-dashboard").flatpickr({
        inline: true,
        prevArrow: "<span title=\"Previous month\">&laquo;</span>",
        nextArrow: "<span title=\"Next month\">&raquo;</span>",
        defaultDate: defaultDate
    });
});
</script> --}}
@endsection

