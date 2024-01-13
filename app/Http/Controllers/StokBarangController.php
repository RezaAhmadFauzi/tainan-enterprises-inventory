<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\StokBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class StokBarangController extends Controller
{
    //
    public function report()
    {
        $data = StokBarang::paginate(10);
        return view('report.StokBarang.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
        
    }

    public function generateReport(Request $request)
    {
        $this->validate($request,[
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date',
        ],[
            'start_date.required' => 'Tidak boleh kosong',
            'end_date.required' => 'Tidak boleh kosong',
            'start_date.before_or_equal' => 'Tanggal mulai harus merupakan tanggal sebelum atau sama dengan tanggal akhir.'
        ]);
        
        $start = Carbon::parse($request->start_date)->format('Y-m-d');
        $end = Carbon::parse($request->end_date)->format('Y-m-d');

        $query = StokBarang::query()
            ->whereDate('tanggal','<=',$end)
            ->whereDate('tanggal','>=',$start);

        $data = $query->get();

        if (!count($data)) {
            return redirect()->back()->with('warning', 'Tidak ada hasil di tanggal tersebut');
        }

        $results = [
            'data' => $data,
            'period' => Carbon::parse($start)->format('d-m-Y') .' - '. Carbon::parse($end)->format('d-m-Y')
        ];

        $pdf = PDF::loadView('report.StokBarang.pdf', compact('results'));
        return $pdf->stream('Laporan-Stok-Barang-Periode-' .$results['period'].'.pdf');
        
    }
}
