@extends('template')
@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Form Ubah Atribut</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('update-atribut', $data->id) }}" class="was-validated" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama-atribut">Nama Atribut:</label>
                <input type="text" class="form-control" id="nama-atribut" placeholder="Enter Nama Atribut" value="{{ $data->nama_atribut }}" name="namaAtribut" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="{{ route('index-atribut') }}" class="btn btn-warning">Cancel</a>
            </div>
        </form>
    </div>
</div>

</div>
@endsection