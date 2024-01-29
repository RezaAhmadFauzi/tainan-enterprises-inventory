@extends('template')
@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Form Tambah Barang keluar</h1>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('store-barangKeluar') }}" class="was-validated" method="POST">
            @csrf
            <div class="form-group">
                <label for="kode-barang-keluar">Kode Barang keluar:</label>
                <input type="text" class="form-control" id="kode-barang-keluar" placeholder="Enter Kode Barang keluar" name="kodeBarangKeluar" value="{{ $kodeBarangKeluar }}" required readonly>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="tanggal-keluar">Tanggal keluar:</label>
                <input type="date" class="form-control" id="tanggal-keluar" placeholder="Select Tanggal Keluar" name="tanggalKeluar" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="jumlah-barang-keluar">Jumlah Barang keluar:</label>
                <input type="number" class="form-control" id="jumlah-barang-keluar" placeholder="Enter Jumlah Barang keluar" name="jumlahKeluar" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="tujuan">Tujuan:</label>
                <input type="te" class="form-control" id="tujuan" placeholder="Enter Tujuan" name="tujuan" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
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
                <div id="dataArray"></div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="{{ route('index-barangKeluar') }}" class="btn btn-warning">Cancel</a>
            </div>
        </form>
    </div>
</div>

</div>
@endsection

@push('script')
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
                // Masukan data ke dalam kolom input
                $('#namaBarang').val(data[0].nama_barang);
                $('#idKategori').val(data[0].kategori.id);
                $('#namaKategori').val(data[0].kategori.nama_kategori);
                $('#namaBrand').val(data[0].brand.nama_brand);

                var nbP =  JSON.parse(data[0].atribute);
                
                $.each(nbP, function(index, value) {
                    $('#dataArray').append('<label>'+ value.attributName, ':' +'</label><input type="text" class="form-control" name="namaBarang" value="'+ value.atributDetailValue +'" readonly><br>');
                });

            },
            error: function(response){
                if (response.status === 404) {
                    alert('Kode Barang Tidak Ditemukan!');
                    $('#namaBarang').val(null);
                    $('#idKategori').val(null);
                    $('#namaKategori').val(null);
                    $('#namaBrand').val(null);

                    for (var i = 1; i < 3; ) {
                        $('#dataArray').append('<label>'+ value.attributName, ':' +'</label><input type="text" class="form-control" name="namaBarang" value="'+ value.atributDetailValue +'" readonly><br>');
                    }

                } else {
                    alert('Error fetching data');
                }
            }
        });
    }
</script>
@endpush