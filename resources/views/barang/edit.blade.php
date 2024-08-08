@extends('template')
@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Form Ubah Barang</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('update-barang', $data->id) }}" class="was-validated" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="kode-barang">Kode Barang:</label>
                <input type="text" class="form-control" id="kode-barang" placeholder="Enter Nama Barang" value="{{ $data->kode_barang }}" name="kodeBarang" readonly>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="nama-barang">Nama Barang:</label>
                <input type="text" class="form-control" id="nama-barang" placeholder="Enter Nama Barang" value="{{ $data->nama_barang }}" name="namaBarang" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="nama-kategori">Kategori:</label>
                <select name="idKategori" class="form-control" id="nama-kategori" required>
                    <option value=""> -- pilih --</option>
                    @foreach ($dataKategori as $kategori)
                        <option @selected($kategori->id == $data->id_kategori) value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
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
                        <option @selected($brand->id == $data->id_brand) value="{{ $brand->id }}">{{ $brand->nama_brand }}</option>
                    @endforeach
                </select>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="nama-brand">Supplier:</label>
                <select name="idSupplier" class="form-control" id="nama-supplier" required>
                    <option value=""> -- pilih --</option>
                    @foreach ($suppliers as $supplier)
                        <option @selected($supplier->id == $data->id_supplier) value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
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
                    @php
                        $barangAttributs = json_decode($data->atribute) ?? [];
                        $collect = collect($barangAttributs);
                        $attributDetailId = $collect->where('atributDetailId', $detail->id)->pluck('atributDetailId')->first();
                    @endphp
                    <option @selected($detail->id == $attributDetailId) value="{{ $detail->id }}">{{ $detail->value }}</option>

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