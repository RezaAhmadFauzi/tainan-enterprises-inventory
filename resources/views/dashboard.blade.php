@extends('template')
@section('content')

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Nama Lokasi', 'Jumlah Barang'],
          <?php echo $namaLokasi; ?>
        ]);

        var options = {
          title: 'Data lokasi pengiriman unit lebih dari 100 di bulan ini'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart2);

      function drawChart2() {

        var data = google.visualization.arrayToDataTable([
          ['Nama Lokasi', 'Jumlah Barang'],
          <?php echo $namaBarang; ?>
        ]);

        var options = {
          title: 'Data barang yang memiliki harga lebih dari 1000 di bulan ini'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart.draw(data, options);
      }
    </script>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Dashboard</h1>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Brand</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['totalBrand'] }}</div>
                        </div>
                        <div class="col-auto">
                            <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Kategori</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['totalCategory'] }}</div>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Supplier</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['totalSupplier'] }}</div>
                            <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">Total : {{ $chart5->total ?? null }}</div> -->
                        </div>
                        <div class="col-auto">
                            <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['totalBarang'] }}</div>
                        </div>
                        <div class="col-auto">
                            <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Barang Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['totalBarangMasuk'] }}</div>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Barang Keluar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['totalBarangKeluar'] }}</div>
                            <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">Total : {{ $chart5->total ?? null }}</div> -->
                        </div>
                        <div class="col-auto">
                            <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Donut Chart -->
        <div class="col-xl-6 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <!-- <h6 class="m-0 font-weight-bold text-primary">Donut Chart</h6> -->
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4">
                    <div id="piechart"></div>
                    </div>
                    <hr>
                    <!-- lokasi yang jumlah barang dikirim lebih dari 100 di bulan ini -->
                    <!-- <code>/js/demo/chart-pie-demo.js</code> file. -->
                </div>
            </div>
        </div>

        <!-- Donut Chart myPieChart2 -->
        <div class="col-xl-6 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <!-- <h6 class="m-0 font-weight-bold text-primary">Donut Chart</h6>  -->
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <div id="piechart2"></div>
                    </div>
                    <hr>
                    <!-- lokasi yang jumlah barang dikirim lebih dari 100 di bulan ini -->
                    <!-- <code>/js/demo/chart-pie-demo.js</code> file. -->
                </div>
            </div>
        </div>
        
    </div>

</div>

<script>
    
</script>
<!-- /.container-fluid -->
@endSection