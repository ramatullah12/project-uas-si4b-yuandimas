@extends('layout.main')

@section('title', 'Rute')

@section('content')
<div class="row">
    <div class="container-fluid bg-light py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h1 class="mb-0">Daftar Rute</h1>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Start</th>
                            <th>Tujuan</th>
                            <th>Harga</th>
                            <th>Transportasi</th>
                            @can('create', App\Pemesanan::class)
                            <th>Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rute as $r)
                            <tr>
                                <td>{{ $r->start }}</td>
                                <td>{{ $r->tujuan }}</td>
                                <td>{{ $r->harga }}</td>
                                <td>{{ $r->transportasi->nama }}</td>
                                @can('create', App\Pemesanan::class)
                                <td>
                                    <a href="{{ route('rute.edit', $r->id) }}" class="btn btn-warning">Ubah</a>
                                    <button class="btn btn-danger delete-btn" data-id="{{ $r->id }}" data-name="{{ $r->start }} - {{ $r->tujuan }}">Hapus</button>
                                    <form id="delete-form-{{ $r->id }}" action="{{ route('rute.destroy', $r->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @can('create', App\Pemesanan::class)
            <a href="{{ route('rute.create') }}" class="btn btn-primary">Tambah Rute</a>
            @endcan
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const routeId = this.getAttribute('data-id');
                const routeName = this.getAttribute('data-name');

                Swal.fire({
                    title: `Apakah yakin ingin menghapus rute ${routeName}?`,
                    text: "Setelah dihapus, data tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, Hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${routeId}`).submit();
                    }
                });
            });
        });
    });

    @if (session('success'))
    Swal.fire({
        title: "Good job!",
        text: "{{ session('success') }}",
        icon: "success"
    });
    @endif
</script>
@endsection
