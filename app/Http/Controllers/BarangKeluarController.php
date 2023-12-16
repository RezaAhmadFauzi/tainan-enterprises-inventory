<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $data = BarangKeluar::paginate(10);

        return view('barangKeluar.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
