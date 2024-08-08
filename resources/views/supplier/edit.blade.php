@extends('template')
@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Form Ubah Supplier</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('update-supplier', $data->id) }}" class="was-validated" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama-supplier">Nama Supplier:</label>
                <input type="text" class="form-control" id="nama-supplier" placeholder="Enter Nama supplier" value="{{ $data->nama_supplier }}" name="namaSupplier" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" placeholder="Enter Alamat" value="{{ $data->alamat }}" name="alamat" required>
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