@extends('layout.main')

@section('title', 'Edit Category')

@section('content')
<div class="row">
    <div class="container-fluid bg-light py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h1 class="mb-0">Edit Category</h1>
            </div>
            <form method="POST" action="{{ route('category.update', $category->id) }}" class="forms-sample">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" placeholder="Category Name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="singkatan">Singkatan</label>
                    <input type="text" class="form-control" id="singkatan" name="singkatan" value="{{ $category->singkatan }}" placeholder="BIS, EKO, EX">
                    @error('singkatan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" value="{{ $category->harga }}" placeholder="Enter price">
                    @error('harga')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary mr-2">Update</button>
                <a href="{{ route('category.index') }}" class="btn btn-light">Cancel</a>
            </form>       
        </div>
    </div>
</div>
@endsection
