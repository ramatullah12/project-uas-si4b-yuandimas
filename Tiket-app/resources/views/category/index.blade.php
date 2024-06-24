@extends('layout.main')

@section('title', 'Category')

@section('content')
<div class="row">
    <div class="container-fluid bg-light py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h1 class="mb-0">Category</h1>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Singkatan</th>
                            <th>Harga</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $cat)
                            <tr>
                                <td>{{ $cat->name }}</td>
                                <td>{{ $cat->singkatan }}</td>
                                <td>{{ $cat->harga }}</td>
                                <td>
                                    <a href="{{ route('category.edit', $cat->id) }}" class="btn btn-warning">Edit</a>
                                    <button class="btn btn-danger" onclick="deleteCategory({{ $cat->id }}, '{{ $cat->name }}')">Delete</button>
                                    <form id="delete-form-{{ $cat->id }}" action="{{ route('category.destroy', $cat->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('category.create') }}" class="btn btn-primary">Tambah Category</a>
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

    // Fungsi untuk menampilkan konfirmasi SweetAlert2 saat menghapus kategori
    function deleteCategory(id, name) {
        Swal.fire({
            title: "Apakah yakin mau menghapus data " + name + "?",
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
