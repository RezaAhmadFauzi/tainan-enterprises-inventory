<?php

namespace App\Http\Controllers;

use App\Helpers\ArrayHelper;
use App\Models\AtributDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AtributDetailController extends Controller
{
    /**
     * @var ArrayHelper
     */
    private $arrayHelper;

    public function __construct()
    {
        $this->arrayHelper = new ArrayHelper();
    }

    public function index($idAtribut)
    {
        $data = AtributDetail::where('id_atribut', $idAtribut)->paginate(10);

        return view('atributDetail.index', compact(
            'data',
            'idAtribut'
            ))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create($idAtribut)
    {
        return view('atributDetail.create', compact('idAtribut'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'value' => [
                'required',
                Rule::unique('atribut_details')->where(function ($query) use($request) {
                    $query->where('id_atribut', $request->idAtribut);
                }),
            ]
        ]);
        
        $inputs = $this->arrayHelper->snakeCaseKey($request->all());
        AtributDetail::create($inputs);
   
        return redirect()->route('index-atributDetail', $inputs['id_atribut'])->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = AtributDetail::findOrFail($id);
        return view('atributDetail.edit', compact('data'));
    }

    public function update($id, Request $request)
    {
        $atributDetail = AtributDetail::findOrFail($id);
        $request->validate([
            'value' => [
                'required',
                Rule::unique('atribut_details')->where(function ($query) use($request) {
                    $query->where('id_atribut', $request->idAtribut);
                })->ignore($atributDetail->id, 'id'),
            ]
        ]);
        
        $inputs = $this->arrayHelper->snakeCaseKey($request->all());
        $atributDetail->update($inputs);
        return redirect()->route('index-atributDetail', $atributDetail->id_atribut)->with('success', 'Data berhasil diubah.');
    }

    public function delete($id)
    {
        $data = AtributDetail::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
