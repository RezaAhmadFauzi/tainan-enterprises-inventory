<?php

namespace App\Http\Controllers;

use App\Helpers\ArrayHelper;
use App\Models\Atribut;
use Illuminate\Http\Request;

class AtributController extends Controller
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
        $data = Atribut::paginate(10);

        return view('atribut.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('atribut.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'namaAtribut' => 'required|string|unique:atributs,nama_atribut'
        ]);
        
        $inputs = $this->arrayHelper->snakeCaseKey($request->all());
        Atribut::create($inputs);
   
        return redirect()->route('index-atribut')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = Atribut::findOrFail($id);
        return view('atribut.edit', compact('data'));
    }

    public function update($id, Request $request)
    {
        $atribut = Atribut::findOrFail($id);
        $request->validate([
            'namaAtribut' => 'required|string|unique:atributs,nama_atribut,' .$id
        ]);
        
        $inputs = $this->arrayHelper->snakeCaseKey($request->all());
        $atribut->update($inputs);
        return redirect()->route('index-atribut')->with('success', 'Data berhasil diubah.');
    }

    public function delete($id)
    {
        $data = Atribut::findOrFail($id);
        $data->delete();
        return redirect()->route('index-atribut')->with('success', 'Data berhasil dihapus.');
    }
}
