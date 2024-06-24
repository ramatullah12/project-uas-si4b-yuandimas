@extends('layout.main')

@section('title', 'Add Category')

@section('content')
<div class="row">
    <div class="container-fluid bg-light py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h1 class="mb-0">Add Category</h1>
            </div>
            <form method="POST" action="{{ route('category.store') }}" class="forms-sample">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Category Name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="singkatan">Singkatan</label>
                    <input type="text" class="form-control" name="singkatan" value="{{ old('singkatan') }}" placeholder="BIS,EKO,EX">
                    @error('singkatan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" name="harga" value="{{ old('harga') }}" min="0" step="0.01" placeholder="Harga">
                    @error('hargac')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('category.index') }}" class="btn btn-light">Cancel</a>
            </form>       
        </div>
    </div>
</div>
@endsection
