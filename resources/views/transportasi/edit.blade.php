@extends('layout.main')

@section('title', 'Edit Transportasi')

@section('content')
<div class="row">
    <div class="container-fluid bg-light py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Edit</h5>
                <h1 class="mb-0">Edit Transportasi</h1>
            </div>
            <form method="POST" action="{{ route('transportasi.update', $transportasi->id) }}" class="forms-sample">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" name="nama" value="{{ old('nama', $transportasi->nama) }}" placeholder="Nama Transportasi">
                    @error('nama')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jenis">Jenis</label>
                    <input type="text" class="form-control" name="jenis" value="{{ old('jenis', $transportasi->jenis) }}" placeholder="Jenis Transportasi">
                    @error('jenis')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('transportasi.index') }}" class="btn btn-light">Batal</a>
            </form>       
        </div>
    </div>
</div>
@endsection
