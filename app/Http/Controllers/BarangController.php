<?php

namespace App\Http\Controllers;

use App\Helpers\ArrayHelper;
use App\Models\Atribut;
use App\Models\AtributDetail;
use App\Models\Barang;
use App\Models\Brand;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
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
        $data = Barang::paginate(10);

        return view('barang.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $kodeBarang = $this->generateKodeBarang();
        $dataKategori = Kategori::all();
        $dataBrand = Brand::all();
        $attributs = Atribut::with('details')->get();
        return view('barang.create', 
            compact('kodeBarang', 'dataKategori', 'dataBrand', 'attributs')
        );
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'kodeBarang' => 'required|string|unique:barangs,kode_barang',
            'namaBarang' => 'required|string|unique:barangs,nama_barang'
        ]);
        
        $inputs = $this->arrayHelper->snakeCaseKey($request->all());
        $array = [];
        if (count($inputs['id_atribut'])) {

            foreach ($inputs['id_atribut'] as $key => $idAtribut) {
                $atributDetailId = $inputs['id_atribut_detail'][$key];
                $atribut = Atribut::find($idAtribut);
                $atributDetail = AtributDetail::find($atributDetailId);
                $data = [
                    'attributId' => $atribut->id,
                    'attributName' => $atribut->nama_atribut,
                    'atributDetailId' => $atributDetail->id,
                    'atributDetailValue' => $atributDetail->value,
                ];

                array_push($array, $data);
            }

            $attribut = collect($array)->reject(function (array $item) {
                return $item['attributId'] == null;
            });

            $inputs['atribute'] = json_encode($attribut) ?? null;
        }
        Barang::create($inputs);
   
        return redirect()->route('index-barang')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = Barang::findOrFail($id);
        $dataKategori = Kategori::all();
        $dataBrand = Brand::all();
        $attributs = Atribut::with('details')->get();
        return view('barang.edit', compact('data', 'dataKategori', 'dataBrand', 'attributs'));
    }

    public function update($id, Request $request)
    {
        $barang = Barang::findOrFail($id);
        $request->validate([
            'kodeBarang' => 'required|string|unique:barangs,kode_barang,' .$id,
            'namaBarang' => 'required|string|unique:barangs,nama_barang,' .$id
        ]);
        
        $inputs = $this->arrayHelper->snakeCaseKey($request->all());
        $array = [];
        if (count($inputs['id_atribut'])) {

            foreach ($inputs['id_atribut'] as $key => $idAtribut) {
                $atributDetailId = $inputs['id_atribut_detail'][$key];
                $atribut = Atribut::find($idAtribut);
                $atributDetail = AtributDetail::find($atributDetailId);
                $data = [
                    'attributId' => $atribut->id,
                    'attributName' => $atribut->nama_atribut,
                    'atributDetailId' => $atributDetail->id,
                    'atributDetailValue' => $atributDetail->value,
                ];

                array_push($array, $data);
            }

            $attribut = collect($array)->reject(function (array $item) {
                return $item['attributId'] == null;
            });

            $inputs['atribute'] = json_encode($attribut) ?? null;
        }
        $barang->update($inputs);
        return redirect()->route('index-barang')->with('success', 'Data berhasil diubah.');
    }

    public function delete($id)
    {
        $data = Barang::findOrFail($id);
        $data->delete();
        return redirect()->route('index-barang')->with('success', 'Data berhasil dihapus.');
    }

    private function generateKodeBarang()
    {
        $latest = Barang::latest()->first();

        if (!$latest) {
            return 'BR-0001';
        }

        $string = preg_replace("/[^0-9\.]/", '', $latest->kode_barang);

        return 'BR-' . sprintf('%04d', $string+1);
    }
}
