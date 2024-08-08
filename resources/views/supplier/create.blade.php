@extends('template')
@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Form Tambah Supplier</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('store-supplier') }}" class="was-validated" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama-supplier">Nama Supplier:</label>
                <input type="text" class="form-control" id="nama-supplier" placeholder="Enter Nama Supplier" name="namaSupplier" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" placeholder="Enter Alamat" name="alamat" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="{{ route('index-supplier') }}" class="btn btn-warning">Cancel</a>
            </div>
        </form>
    </div>
</div>

</div>
@endsection