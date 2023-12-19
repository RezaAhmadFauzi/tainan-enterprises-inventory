@extends('template')
@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Form Ubah Value</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('update-atributDetail', $data->id) }}" class="was-validated" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="value">Nama Value:</label>
                <input type="text" class="form-control" id="value" placeholder="Enter Value" value="{{ $data->value }}" name="value" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="{{ route('index-atributDetail', $data->id_atribut) }}" class="btn btn-warning">Cancel</a>
            </div>
        </form>
    </div>
</div>

</div>
@endsection