@extends('layouts.app')

@section('content')
    <h4 class="fw-semibold mb-4">{{ $title }}</h4>
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('master-data.pengguna.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label" for="title">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="title"
                                name="name" required value="{{ $user->name }}" />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="title">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="title"
                                name="email" required value="{{ $user->email }}" />
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="title">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="title" name="password" />
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="title">Peran</label>
                            <select name="role" class="form-control @error('role') is-invalid @enderror"
                                onchange="showFakultasNameField()">
                                <option value="">Pilih Peran</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ $role->name === $user->getRoleNames()[0] ? 'selected' : '' }}>{{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="title">Nama Fakultas</label>
                            <input type="text" class="form-control @error('nama_fakultas') is-invalid @enderror"
                                id="title" name="nama_fakultas" value="{{ $user->Fakultas->nama ?? '' }}" />
                            @error('nama_fakultas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if (session('error'))
        <script>
            Swal.fire(
                'Error!',
                `{{ session('error') }}`,
                'error'
            )
        </script>
    @endif
    <script>
        $(document).ready(function() {
            showFakultasNameField()
        })

        function showFakultasNameField() {
            const role = document.querySelector('select[name="role"]').value;
            const fakultasNameField = document.querySelector('input[name="nama_fakultas"]').closest('.mb-3');

            if (role === 'Fakultas') {
                fakultasNameField.classList.remove('d-none')
            } else {
                fakultasNameField.classList.add('d-none')
            }
        }
    </script>
@endpush
