<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        $data = BarangMasuk::paginate(10);

        return view('barangMasuk.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
