@extends('layout.main')

@section('title', 'Edit Pemesanan')

@section('content')
<div class="row">
    <div class="container-fluid bg-light py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Edit</h5>
                <h1 class="mb-0">Edit Pemesanan</h1>
            </div>
            <form method="POST" action="{{ route('pemesanan.update', $pemesanan->id) }}" class="forms-sample">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $pemesanan->nama) }}">
                    @error('nama')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="rute_id">Rute</label>
                    <select name="rute_id" class="form-control" id="rute_id">
                        @foreach ($rute as $r)
                            <option value="{{ $r->id }}" data-harga="{{ $r->harga }}" {{ $pemesanan->rute_id == $r->id ? 'selected' : '' }}>
                                {{ $r->start }} - {{ $r->tujuan }}
                            </option>
                        @endforeach
                    </select>
                    @error('rute_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="transportasi_id">Transportasi</label>
                    <select name="transportasi_id" class="form-control" id="transportasi_id">
                        @foreach ($transportasi as $transport)
                            <option value="{{ $transport->id }}" {{ $pemesanan->transportasi_id == $transport->id ? 'selected' : '' }}>
                                {{ $transport->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('transportasi_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category_id">Kategori</label>
                    <select name="category_id" class="form-control" id="category_id">
                        @foreach ($category as $cat)
                            <option value="{{ $cat->id }}" {{ $pemesanan->category_id == $cat->id ? 'selected' : '' }} data-harga="{{ $cat->harga_per_tiket }}">
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
                    <input type="datetime-local" class="form-control" name="tanggal_pemesanan" value="{{ old('tanggal_pemesanan', $pemesanan->tanggal_pemesanan) }}">
                    @error('tanggal_pemesanan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jumlah_tiket">Jumlah Tiket</label>
                    <input type="number" class="form-control" id="jumlah_tiket" name="jumlah_tiket" value="{{ old('jumlah_tiket', $pemesanan->jumlah_tiket) }}" min="1">
                    @error('jumlah_tiket')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="harga_per_tiket">Harga per Tiket</label>
                    <input type="text" class="form-control" id="harga_per_tiket" readonly>
                </div>
                <div class="form-group">
                    <label for="total_harga">Total Harga</label>
                    <input type="number" class="form-control" id="total_harga" name="total_harga" value="{{ old('total_harga', $pemesanan->total_harga) }}" min="0" step="0.01" readonly>
                    @error('total_harga')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary d-inline-block">Submit</button>
                <a href="{{ route('pemesanan.index') }}" class="btn btn-light d-inline-block ml-2">Batal</a>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ruteSelect = document.getElementById('rute_id');
        const jumlahTiketInput = document.getElementById('jumlah_tiket');
        const hargaPerTiketInput = document.getElementById('harga_per_tiket');
        const totalHargaInput = document.getElementById('total_harga');
        const categorySelect = document.getElementById('category_id');

        function calculateTotalHarga() {
            const selectedRute = ruteSelect.options[ruteSelect.selectedIndex];
            const hargaPerTiketRute = selectedRute ? selectedRute.getAttribute('data-harga') : 0;
            const jumlahTiket = jumlahTiketInput.value;
            const selectedCategory = categorySelect.options[categorySelect.selectedIndex];
            const hargaPerTiketCategory = selectedCategory ? selectedCategory.getAttribute('data-harga') : 0;

            let hargaPerTiket = 0;

            if (hargaPerTiketRute > 0) {
                hargaPerTiket = hargaPerTiketRute;
            } else if (hargaPerTiketCategory > 0) {
                hargaPerTiket = hargaPerTiketCategory;
            }

            if (hargaPerTiket && jumlahTiket) {
                const totalHarga = hargaPerTiket * jumlahTiket;
                hargaPerTiketInput.value = hargaPerTiket;
                totalHargaInput.value = totalHarga;
            } else {
                hargaPerTiketInput.value = '';
                totalHargaInput.value = '';
            }
        }

        ruteSelect.addEventListener('change', calculateTotalHarga);
        jumlahTiketInput.addEventListener('input', calculateTotalHarga);
        categorySelect.addEventListener('change', calculateTotalHarga);

        // Trigger calculation on page load
        calculateTotalHarga();
    });
</script>
@endsection
