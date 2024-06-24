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
                                <td>
                                  @can('create', App\Pemesanan::class)
                                    <a href="{{ route('rute.edit', $r->id) }}" class="btn btn-warning">Ubah</a>
                                    <button class="btn btn-danger delete-btn" data-id="{{ $r->id }}" data-name="{{ $r->start }} - {{ $r->tujuan }}">Hapus</button>
                                    <form id="delete-form-{{ $r->id }}" action="{{ route('rute.destroy', $r->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                  @endcan
                                </td>
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

@if (session('success'))     
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        title: "Good job!",
        text: "{{ session('success') }}",
        icon: "success"
    });
</script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let deleteButtons = document.querySelectorAll('.delete-btn');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                let id = this.getAttribute('data-id');
                let name = this.getAttribute('data-name');

                Swal.fire({
                    title: "Apakah yakin mau menghapus data " + name + "?",
                    text: "Setelah dihapus, data tidak bisa dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, Hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        let form = document.getElementById('delete-form-' + id);
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection
