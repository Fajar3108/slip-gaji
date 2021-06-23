@extends('layouts.app')

@section('content')
<main class="content">
    <div class="container-fluid">
        <div class="mb-3">
            <div class="row">

                {{-- <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="https://www.german.pitt.edu/sites/default/files/styles/person_small/public/person-images/20180927_AO_504_German_Portrait_0123_01.jpg?itok=_nZ0KXlh" alt="{{ auth()->user()->name }}" class="rounded-circle mb-2" width="128" height="128" style="object-fit: cover"/>
                            <h5 class="card-title mb-0">{{ auth()->user()->name }}</h5>
                            <div class="text-muted mb-2">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-12">
                    <div class="row m-0">
                        <div class="card col-12">
                            <div class="card-body">
                                <form action="{{ route('user-profile-information.update') }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" placeholder="Your Name" value="{{ old('name') ?? auth()->user()->name }}" name="name" id="name">
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" placeholder="Your Mail" value="{{ old('email') ?? auth()->user()->email }}" name="email" id="email">
                                        @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                </form>
                            </div>
                        </div>
                        <div class="card col-12">
                            <div class="card-body">
                                <form action="{{ route('user-password.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input type="password" class="form-control" name="current_password" id="current_password">
                                    @error('current_password', 'updatePassword')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" name="password" id="password">
                                    @error('password', 'updatePassword')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                                    @error('password_confirmation', 'updatePassword')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
