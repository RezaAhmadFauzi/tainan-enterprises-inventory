@extends('template')
@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Form Tambah Barang Masuk</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="" class="was-validated" method="POST">
            @csrf
            <div class="form-group">
                <label for="kode-barang-masuk">Kode Barang Masuk:</label>
                <input type="text" class="form-control" id="kode-barang-masuk" placeholder="Enter Kode Barang Masuk" name="koder_barang_masuk" value="{{ $kodeBarangMasuk }}" required readonly>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="tanggal-masuk">Tanggal Masuk:</label>
                <input type="date" class="form-control" id="tanggal-masuk" placeholder="Select Tanggal Masuk" name="tanggal_masuk" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="kode-barang">Kode Barang:</label>
                <input type="text" class="form-control" id="kode-barang" placeholder="Enter Kode Barang" name="kode_barang" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <form>
                <div class="form-group">
                    <label for="kodeBarang">Kode Barang:</label>
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="kodeBarang" name="kodeBarang">
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-secondary" onclick="getData()">Cari</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="namaBrand">Brand:</label>
                    <input type="text" class="form-control" name="namaBrand" id="namaBrand" readonly>
                </div>
                <div class="form-group">
                    <label for="namaKategori">Kategori:</label>
                    <input type="text" class="form-control" name="namaKategori" id="namaKategori" readonly>
                    <input type="hidden" class="form-control" name="idKategori" id="idKategori">
                </div>
                <div class="form-group">
                    <label for="namaBarang">Quality Code:</label>
                    <input type="text" class="form-control" name="namaBarang" id="namaBarang" readonly>
                </div>
            </form>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="{{ route('index-barangMasuk') }}" class="btn btn-warning">Cancel</a>
            </div>
        </form>
    </div>
</div>

</div>
@endsection

@push('script')
<?php
    $json_object = '{"data"}';
?>
<script>
        function getData() {
            // Mengambil nilai ID dari kolom input
            var kodeBarang = $('#kodeBarang').val();
            // Mengambil data kategori dari server menggunakan Ajax
            $.ajax({
                url: '/get-data/' + kodeBarang,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    // Memasukkan data ke dalam kolom input
                    $('#namaBarang').val(data[0].nama_barang);
                    $('#idKategori').val(data[0].kategori.id);
                    $('#namaKategori').val(data[0].kategori.nama_kategori);
                    $('#namaBrand').val(data[0].brand.nama_brand);
                },
                error: function(response){
                    if (response.status === 404) {
                        alert('Category not found');
                    } else {
                        alert('Error fetching data');
                    }
                }
            });
        }
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.0/axios.min.js"></script>
<script src="{{ asset('template/js/search-barang.js') }}"></script>
@endpush