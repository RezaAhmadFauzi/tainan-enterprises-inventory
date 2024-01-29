<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Brand;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function view(Request $request)
    {
        $totalBrand = Brand::count();
        $totalCategory = Kategori::count();
        $totalSupplier = Supplier::count();
        $totalBarang = Barang::count();
        $totalBarangMasuk = BarangMasuk::count();
        $totalBarangKeluar = BarangKeluar::count();

        $data = [
            'totalBrand' => $totalBrand,
            'totalCategory' => $totalCategory,
            'totalSupplier' => $totalSupplier,
            'totalBarang' => $totalBarang,
            'totalBarangMasuk' => $totalBarangMasuk,
            'totalBarangKeluar' => $totalBarangKeluar,
        ];

        $namaLokasi = 'Dimana Aja';
        $namaBarang = 'Test';
        return view(
            'dashboard', 
            compact(
                'namaLokasi', 
                'namaBarang',
                'data'
            )
        );
    }
}
