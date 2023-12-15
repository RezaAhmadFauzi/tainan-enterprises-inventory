<?php

namespace App\Http\Controllers;

use App\Helpers\ArrayHelper;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
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
        $data = Kategori::paginate(10);

        return view('kategori.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('kategori.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'namaKategori' => 'required|string|unique:kategoris,nama_kategori'
        ]);
        
        $inputs = $this->arrayHelper->snakeCaseKey($request->all());
        Kategori::create($inputs);
   
        return redirect()->route('index-kategori')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = Kategori::findOrFail($id);
        return view('kategori.edit', compact('data'));
    }

    public function update($id, Request $request)
    {
        $kategori = Kategori::findOrFail($id);
        $request->validate([
            'namaKategori' => 'required|string|unique:kategoris,nama_kategori,' .$id
        ]);
        
        $inputs = $this->arrayHelper->snakeCaseKey($request->all());
        $kategori->update($inputs);
        return redirect()->route('index-kategori')->with('success', 'Data berhasil diubah.');
    }

    public function delete($id)
    {
        $data = Kategori::findOrFail($id);
        $data->delete();
        return redirect()->route('index-kategori')->with('success', 'Data berhasil dihapus.');
    }
}
