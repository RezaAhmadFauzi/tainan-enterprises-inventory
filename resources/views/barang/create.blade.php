@extends('template')
@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Form Tambah Barang</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('store-barang') }}" class="was-validated" method="POST">
            @csrf
            <div class="form-group">
                <label for="kode-barang">Kode Barang:</label>
                <input type="text" class="form-control" id="kode-barang" value="{{ $kodeBarang }}" name="kodeBarang" required readonly>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="nama-barang">Nama Barang:</label>
                <input type="text" class="form-control" id="nama-barang" placeholder="Enter Nama Barang" name="namaBarang" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="nama-kategori">Kategori:</label>
                <select name="idKategori" class="form-control" id="nama-kategori" required>
                    <option value=""> -- pilih --</option>
                    @foreach ($dataKategori as $kategori)
                        <option value="{{ $kategori->id }}"> {{ $kategori->nama_kategori }} </option>
                    @endforeach
                </select>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="nama-brand">Brand:</label>
                <select name="idBrand" class="form-control" id="nama-brand" required>
                    <option value=""> -- pilih --</option>
                    @foreach ($dataBrand as $brand)
                        <option value="{{ $brand->id }}"> {{ $brand->nama_brand }} </option>
                    @endforeach
                </select>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>

            @foreach ($attributs as $attribut)

            @php
                $attributName = $attribut->nama_atribut ?? null;
                $details = $attribut->details ?? [];
            @endphp

            <div class="form-group">
                <input type="hidden" class="form-control" value="{{ $attribut->id }}" name="idAtribut[]">
                <label for="{{ $attributName }}">{{ $attributName }}:</label>
                <select name="idAtributDetail[]" class="form-control" id="{{ $attributName }}">
                    <option value=""> -- pilih --</option>
                    @foreach ($details as $detail)
                    <option value="{{ $detail->id }}"> {{ $detail->value }} </option>
                    @endforeach
                </select>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            @endforeach

            <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="{{ route('index-barang') }}" class="btn btn-warning">Cancel</a>
            </div>
        </form>
    </div>
</div>

</div>
@endsection