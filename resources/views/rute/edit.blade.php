@extends('layout.main')

@section('title', 'Edit Rute')

@section('content')
<div class="row">
    <div class="container-fluid bg-light py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Edit</h5>
                <h1 class="mb-0">Edit Rute</h1>
            </div>
            <form method="POST" action="{{ route('rute.update', $rute->id) }}" class="forms-sample">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="start">Start</label>
                    <input type="text" class="form-control" name="start" value="{{ old('start', $rute->start) }}" placeholder="Palembang, Jakarta,....">
                    @error('start')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tujuan">Tujuan</label>
                    <input type="text" class="form-control" name="tujuan" value="{{ old('tujuan', $rute->tujuan) }}" placeholder="Palembang, Jakarta,....">
                    @error('tujuan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" class="form-control" name="harga" value="{{ old('harga', $rute->harga) }}" placeholder="Harga">
                    @error('harga')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="transportasi_id">Transportasi</label>
                    <select name="transportasi_id" class="form-control">
                        @foreach ($transportasi as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $rute->transportasi_id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('transportasi_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('rute.index') }}" class="btn btn-light">Batal</a>
            </form>       
        </div>
    </div>
</div>
@endsection
