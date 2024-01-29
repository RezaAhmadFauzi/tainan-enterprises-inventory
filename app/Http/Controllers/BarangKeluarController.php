<?php

namespace App\Http\Controllers;

use App\Helpers\ArrayHelper;
use App\Models\Barang;
use App\Models\BarangKeluar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class BarangKeluarController extends Controller
{
    /**
     * @var ArrayHelper
     */
    private $arrayHelper;

    public function __construct()
    {
        $this->arrayHelper = new ArrayHelper();
    }

    public function index()
    {
        $data = BarangKeluar::paginate(10);

        return view('barangKeluar.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function report()
    {
        $data = BarangKeluar::paginate(10);

        return view('report.BarangKeluar.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $kodeBarang = Barang::all();
        $kodeBarangKeluar = $this->generateKodeBarangKeluar();
        return view('barangKeluar.create', compact('kodeBarangKeluar', 'kodeBarang'));
    }

    public function store(Request $request)
    {
        $idBarang = Barang::where('kode_barang', $request->kodeBarang)->pluck('id')->first();
        
        $inputs = $this->arrayHelper->snakeCaseKey($request->all());
        $inputs['id_barang'] = $idBarang;
        BarangKeluar::create($inputs);
   
        return redirect()->route('index-barangKeluar')->with('success', 'Data berhasil ditambahkan.');
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

        $query = BarangKeluar::query()
            ->whereDate('created_at','<=',$end)
            ->whereDate('created_at','>=',$start);

        $data = $query->get();

        if (!count($data)) {
            return redirect()->back()->with('warning', 'Tidak ada hasil di tanggal tersebut');
        }

        $results = [
            'data' => $data,
            'period' => Carbon::parse($start)->format('d-m-Y') .' - '. Carbon::parse($end)->format('d-m-Y')
        ];

        $pdf = PDF::loadView('report.BarangKeluar.pdf', compact('results'));
        return $pdf->stream('Laporan-Barang-Keluar-Periode-' .$results['period'].'.pdf');
        
    }

    private function generateKodeBarangKeluar()
    {
        $latest = BarangKeluar::latest()->first();
        
        if (!$latest) {
            return 'KBK-0001';
        }

        $string = preg_replace("/[^0-9\.]/", '', $latest->kode_barang_keluar);

        return 'KBK-' . sprintf('%04d', $string+1);
    }

    public function delete($id)
    {
        $data = BarangKeluar::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
