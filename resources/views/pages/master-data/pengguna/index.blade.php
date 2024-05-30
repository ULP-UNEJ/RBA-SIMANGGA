@extends('layouts.app')

@section('content')
    <h4 class="fw-semibold mb-4">Daftar {{ $title }}</h4>

    @can('users.web.create')
        <div class="mb-4" style="width: 15%">
            <a href="{{ route('master-data.pengguna.create') }}" class="btn btn-primary mb-2 text-nowrap add-new-role">
                Tambah {{ $title }}
            </a>
        </div>
    @endcan

    <!-- Table -->
    <div class="card">

        <div class="card-datatable table-responsive">
            {{ $dataTable->table(['class' => 'datatables table border-top']) }}
        </div>
    </div>
    <!--/  Table -->

    <!-- /Modal -->
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
@endsection

@push('scripts')
    <!-- Page JS -->
    {{ $dataTable->scripts() }}
    @if (session('success'))
        <script>
            Swal.fire(
                'Success!',
                '{{ session('success') }}',
                'success'
            )
        </script>
    @elseif($errors->any())
        <script>
            Swal.fire(
                'Error!',
                'Terdapat kesalahan saat menambahkan peran baru. Mohon periksa kembali form yang diisi',
                'error'
            )
        </script>
    @elseif(session('error'))
        <script>
            Swal.fire(
                'Error!',
                '{{ session('error') }}',
                'error'
            )
        </script>
    @endif
    <script>
        function deletePengguna(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan data yang telah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`form#deletePengguna${id}`).submit();
                }
            })
        }
    </script>
@endpush
