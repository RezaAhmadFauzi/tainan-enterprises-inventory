@extends('template')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Laporan Barang Keluar</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form action="{{ route('generate-report-barangKeluar') }}">
                <div class="row">
                    <div class="col-md-2">
                        <label for="">Tanggal Awal</label>
                        <input type="date" class="form-control" id="tanggal-awal" placeholder="Select Tanggal awal" name="start_date" required>
                    </div>
                    <div class="col-md-2">
                        <label for="">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tanggal-akhir" placeholder="Select Tanggal akhir" name="end_date" required>
                    </div>
                    <div class="col-md-2" style="padding-top: 30px;">
                        <button type="submit" class="btn btn-primary" target="_blank">
                             Cetak
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-striped" style="width:100%">
                <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Keluar</th>
                            <th>Tanggal Keluar</th>
                            <th>Tujuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                        <tr {!! $loop->odd ? 'style="background: #F0F5F9;" ' : '' !!}>
                            <td class="wrap-all">{{ $loop->index + 1 }}</td>
                            <td>{{ $row['kode_barang'] }}</td>
                            <td>{{ $row->barang->nama_barang}}</td>
                            <td>{{ $row['jumlah_keluar'] }}</td>
                            <td>{{ $row['tanggal_keluar'] }}</td>
                            <td>{{ $row['tujuan'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

