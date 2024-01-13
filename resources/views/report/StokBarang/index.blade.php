@extends('template')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Laporan Stok Barang</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form action="{{ route('generate-report-stokBarang') }}">
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
                        <button type="submit" class="btn btn-danger" target="_blank">
                        <i class="fas fa-file-pdf"> PDF </i>
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
                            <th>Stok Awal</th>
                            <th>Jumlah Masuk</th>
                            <th>Jumlah Keluar</th>
                            <th>Stok Akhirr</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                        <tr {!! $loop->odd ? 'style="background: #F0F5F9;" ' : '' !!}>
                            <td class="wrap-all">{{ $loop->index + 1 }}</td>
                            <td>{{ $row['kode_barang'] }}</td>
                            <td>{{ $row['stok_awal']}}</td>
                            <td>{{ $row['stok_masuk'] }}</td>
                            <td>{{ $row['stok_keluar'] }}</td>
                            <td>{{ $row['stok_akhir'] }}</td>
                            <td>{{ $row['tanggal'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
    $('#datepickerStart').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#datepickerStart').datepicker("setDate", new Date());
    $('#datepickerEnd').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#datepickerEnd').datepicker("setDate", new Date());
</script>
@endpush

