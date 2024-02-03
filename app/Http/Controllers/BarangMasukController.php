<?php

namespace App\Http\Controllers;

use App\Helpers\ArrayHelper;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\StokBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDF;

class BarangMasukController extends Controller
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

        $query = BarangMasuk::query()
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

        $pdf = PDF::loadView('report.BarangMasuk.pdf', compact('results'));
        return $pdf->stream('Laporan-Barang-Masuk-Periode-' .$results['period'].'.pdf');
        
    }

    public function store(Request $request)
    {

        $existData = BarangMasuk::where('kode_barang', $request->kodeBarang)
            ->where('tanggal_masuk', $request->tanggalMasuk)
            ->first();
        
        if ($existData) {
            return redirect()->back()->with('error', 'Tidak bisa menambahkan data di tanggal yang sama dengan kode barang yang sama');
        }

        $idBarang = Barang::where('kode_barang', $request->kodeBarang)->pluck('id')->first();
        
        $inputs = $this->arrayHelper->snakeCaseKey($request->all());
        $inputs['id_barang'] = $idBarang;
        
        DB::beginTransaction();
        try {
            BarangMasuk::create($inputs);

            $stokBarang = StokBarang::where('kode_barang', $request->kodeBarang)->first();

            if ($stokBarang) {
                $stokBarang->stok_masuk = $stokBarang->stok_masuk + $inputs['jumlah_masuk'];
                $stokBarang->stok_akhir = $stokBarang->stok_akhir + $inputs['jumlah_masuk'];
                $stokBarang->tanggal = Carbon::now()->format('Y-m-d');
                $stokBarang->save();
            }else {
                StokBarang::create([
                    'kode_barang' => $inputs['kode_barang'],
                    'stok_awal' => $inputs['jumlah_masuk'],
                    'stok_masuk' => $inputs['jumlah_masuk'],
                    'stok_keluar' => null,
                    'stok_akhir' => $inputs['jumlah_masuk'],
                    'tanggal' => $inputs['tanggal_masuk']
                ]);
            }
            DB::commit();
    
            return redirect()->route('index-barangMasuk')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            return redirect()->route('index-barangMasuk')->with('error', 'Oops terjadi kesalahan, Mohon untuk menghubungi teknisi');
        }
    }

    public function delete($id)
    {
        $data = BarangMasuk::findOrFail($id);

        DB::beginTransaction();
        try {
            $stokBarang = StokBarang::where('kode_barang', $data->kode_barang)->first();
            if ($stokBarang) {
                $stokBarang->stok_masuk = $stokBarang->stok_masuk - $data->jumlah_masuk; 
                $stokBarang->stok_akhir = $stokBarang->stok_akhir - $data->jumlah_masuk;
                $stokBarang->save(); 
            }
            $data->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            return redirect()->route('index-barangMasuk')->with('error', 'Oops terjadi kesalahan, Mohon untuk menghubungi teknisi');
        }
    }
}
