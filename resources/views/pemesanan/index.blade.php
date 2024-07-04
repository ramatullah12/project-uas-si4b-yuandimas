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
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Rute</th>
                        <th>Transportasi</th>
                        <th>Category</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Jumlah Tiket</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pemesanan as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->rute->start }} - {{ $item->rute->tujuan }}</td>
                        <td>{{ $item->transportasi->nama }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->tanggal_pemesanan }}</td>
                        <td>{{ $item->jumlah_tiket }}</td>
                        <td>{{ number_format($item->total_harga, 2) }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('pemesanan.edit', $item->id) }}" class="btn btn-warning btn-sm mr-2">Ubah</a>
                                <button class="btn btn-danger btn-sm" onclick="deletePemesanan({{ $item->id }}, '{{ $item->nama }}')">Hapus</button>
                                <form id="delete-form-{{ $item->id }}" action="{{ route('pemesanan.destroy', $item->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
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
    function deletePemesanan(id, name) {
        Swal.fire({
            title: "Apakah yakin ingin menghapus pemesanan atas nama " + name + "?",
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
