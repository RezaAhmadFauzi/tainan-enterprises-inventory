<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        $data = BarangMasuk::paginate(10);

        return view('barangMasuk.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $kodeBarang = Barang::all();
        $kodeBarangMasuk = $this->generateKodeBarangMasuk();
        return view('barangMasuk.create', compact('kodeBarangMasuk', 'kodeBarang'));
    }

    private function generateKodeBarangMasuk()
    {
        $latest = BarangMasuk::latest()->first();
        
        if (!$latest) {
            return 'KBM-0001';
        }

        $string = preg_replace("/[^0-9\.]/", '', $latest->kode_barang_masuk);

        return 'KBM-' . sprintf('%04d', $string+1);
    }

    public function report()
    {
        $data = BarangMasuk::paginate(10);

        return view('report.BarangMasuk.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
