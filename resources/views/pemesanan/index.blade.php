@extends('layout.main')

@section('title', 'Pemesanan')

@section('content')
<div class="row">
    <div class="container-fluid bg-light py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h1 class="mb-0">Daftar Pemesanan</h1>
            </div>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Rute</th>
                            <th>Transportasi</th>
                            <th>Category</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Jumlah Tiket</th>
                            <th>Total Harga</th>
                            @can('create', App\Pemesanan::class)
                            <th>Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pemesanan as $p)
                            <tr>
                                <td>{{ $p->rute->start }} - {{ $p->rute->tujuan }}</td>
                                <td>{{ $p->transportasi->nama }}</td>
                                <td>{{ $p->category->name }}</td>
                                <td>{{ $p->tanggal_pemesanan }}</td>
                                <td>{{ $p->jumlah_tiket }}</td>
                                <td>{{ $p->total_harga }}</td>
                          <!-- Menampilkan nama kategori -->
                                <td>
                                  @can('create', App\Pemesanan::class)
                                    <a href="{{ route('pemesanan.edit', $p->id) }}" class="btn btn-warning">Ubah</a>
                                    <form id="delete-form-{{ $p->id }}" action="{{ route('pemesanan.destroy', $p->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="deletePemesanan({{ $p->id }}, '{{ $p->rute->start }} - {{ $p->rute->tujuan }}')">Hapus</button>
                                    </form>
                                  @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('pemesanan.create') }}" class="btn btn-primary">Tambah Pemesanan</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // SweetAlert2 untuk pesan sukses
    @if (session('success'))
        Swal.fire({
            title: "Berhasil!",
            text: "{{ session('success') }}",
            icon: "success"
        });
    @endif

    // Fungsi untuk menampilkan konfirmasi SweetAlert2 saat menghapus pemesanan
    function deletePemesanan(id, route) {
        Swal.fire({
            title: "Apakah yakin ingin menghapus pemesanan dengan rute " + route + "?",
            text: "Setelah dihapus, data tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Mencegah aksi default form saat tombol "Ya, Hapus!" diklik
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection
