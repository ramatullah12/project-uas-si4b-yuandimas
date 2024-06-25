@extends('layout.main')

@section('title', 'Transportasi')

@section('content')
<div class="row">
    <div class="container-fluid bg-light py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h1 class="mb-0">Daftar Transportasi</h1>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jenis</th>
                            @can('create', App\Pemesanan::class)
                            <th>Actions</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transportasi as $transport)
                            <tr>
                                <td>{{ $transport->nama }}</td>
                                <td>{{ $transport->jenis }}</td>
                                <td>
                                  @can('create', App\Pemesanan::class)
                                    <a href="{{ route('transportasi.edit', $transport->id) }}" class="btn btn-warning">Ubah</a>
                                    <button class="btn btn-danger" onclick="deleteTransportasi({{ $transport->id }}, '{{ $transport->nama }}')">Hapus</button>
                                    <form id="delete-form-{{ $transport->id }}" action="{{ route('transportasi.destroy', $transport->id) }}" method="POST" style="display: none;">
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
            <a href="{{ route('transportasi.create') }}" class="btn btn-primary">Tambah Transportasi</a>
            @endcan
          </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // SweetAlert2 untuk pesan sukses
    @if (session('success'))
        Swal.fire({
            title: "Good job!",
            text: "{{ session('success') }}",
            icon: "success"
        });
    @endif

    // Fungsi untuk menampilkan konfirmasi SweetAlert2 saat menghapus transportasi
    function deleteTransportasi(id, name) {
        Swal.fire({
            title: "Apakah yakin ingin menghapus transportasi " + name + "?",
            text: "Setelah dihapus, data tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Mencegah aksi default form saat tombol "Ya, Hapus!" diklik
                event.preventDefault();
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection
