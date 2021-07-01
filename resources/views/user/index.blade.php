@extends('layouts.app')

@section('content')
<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row">
            <div class="col-12 d-table mt-3">
                <div class="d-table-cell align-middle">
                    <div class="card">
                        <div class="card-header m-0 row">
                            <div class="col-6 d-flex">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formUser" onclick="createModal()">
                                Create
                                </button>
                                {{-- User Import --}}
                                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Import
                                </button>
                                <div class="dropdown-menu">
                                    <form class="px-4 py-3" action="{{ route('user.import') }}" method="POST" aria-labelledby="dropdownMenuButton1" enctype="multipart/form-data">
                                        @csrf
                                        <div class="d-flex">
                                            <div class="input-group">
                                                <input type="file" name="file" required="required" class="form-control">
                                            </div>
                                            <button class="btn btn-success" type="submit" id="importButton">Submit</button>
                                        </div>
                                        @error('file')
                                            <small class="text-danger mt-1">{{ $message }}</small>
                                        @enderror
                                    </form>
                                </div>
                            </div>
                            <div class="col-6">
                                <form class="d-flex" action="{{ route('user.search') }}">
                                    <input type="text" class="form-control" placeholder="search here.." id="searchUserInput" name="keyword">
                                    <button type="submit" class="btn btn-primary" id="searchButton">Search</button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover my-0" id="usersTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>NIK</th>
                                        <th>Role / Position</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="dataUsers">
                                    <?php $id = $users->currentPage() > 1 ? ($users->currentPage() - 1) * $users->perPage() + 1 : 1; ?>
                                    @if ($users->count() <= 0)
                                    <tr><td colspan="7" class="h2 p-4 text-center m-0">Not Found</td></tr>
                                    @endif
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $id++ }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->nik }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="row">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="col-6 btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#formUser" onclick="editModal({{ $user }})">Edit</button>
                                                <button type="submit" class="col-6 btn btn-danger btn-sm" onclick="deleteConfirm(event)">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="formUser" tabindex="-1" aria-labelledby="formUserLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formUserLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalBody">
        <form action="" method="POST" id="userForm">
            @csrf
            <div>
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-3" id="inputRole">
                <label for="role" class="form-label">Role</label>
                <input type="text" class="form-control" name="role" id="role">
                @error('role')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-3">
                <label for="nik" class="form-label">Nik</label>
                <input type="number" class="form-control" name="nik" id="nik">
                @error('nik')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-3">
                <label for="password" class="form-label">Password Default => password</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('custom-scripts')

<script>
    const deleteConfirm = (event) => {
        const result = confirm('Are you sure');
        if (!result) event.preventDefault();
    }

    const createModal = () => {
        document.querySelector('#formUserLabel').textContent = "Create";
        form.action = `/user`;
        name.value = '';
        email.value = '';
        role.value = '';
    }

    const editModal = (user) => {
        document.querySelector('#formUserLabel').textContent = "Edit";
        form.action = `/user/${user.id}`;
        name.value = user.name;
        email.value = user.email;
        role.value = user.role.name;
        nik.value = user.nik;
    }

    // Variabel Declaration
    const name = document.querySelector('#name');
    const email = document.querySelector('#email');
    const role = document.querySelector('#role');
    const nik = document.querySelector('#nik');
    const form = document.querySelector('#userForm');
</script>

@endsection
