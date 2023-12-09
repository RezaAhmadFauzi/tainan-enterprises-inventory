<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function view(Request $request)
    {
        $chart1 = null;
        $chart2 = null;
        $chart3 = null;
        $chart4 = null;
        $chart5 = null;
        $namaLokasi = 'Dimana Aja';
        $namaBarang = 'Test';
        return view('dashboard', compact('chart1', 'chart2', 'chart3', 'chart4', 'chart5', 'namaLokasi', 'namaBarang'));
    }
}
