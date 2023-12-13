@extends('template')
@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Form Tambah Brand</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('store-brand') }}" class="was-validated" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama-brand">Nama Brand:</label>
                <input type="text" class="form-control" id="nama-brand" placeholder="Enter Nama Brand" name="namaBrand" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="{{ route('index-brand') }}" class="btn btn-warning">Cancel</a>
            </div>
        </form>
    </div>
</div>

</div>
@endsection