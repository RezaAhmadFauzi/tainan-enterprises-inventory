<?php

namespace App\Http\Controllers;

use App\Helpers\ArrayHelper;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
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
        $data = Brand::paginate(10);

        return view('brand.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('brand.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'namaBrand' => 'required|string|unique:brands,nama_brand'
        ]);
        
        $inputs = $this->arrayHelper->snakeCaseKey($request->all());
        Brand::create($inputs);
   
        return redirect()->route('index-brand')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = Brand::findOrFail($id);
        return view('brand.edit', compact('data'));
    }

    public function update($id, Request $request)
    {
        $brand = Brand::findOrFail($id);
        $request->validate([
            'namaBrand' => 'required|string|unique:brands,nama_brand,' .$id
        ]);
        
        $inputs = $this->arrayHelper->snakeCaseKey($request->all());
        $brand->update($inputs);
        return redirect()->route('index-brand')->with('success', 'Data berhasil diubah.');
    }

    public function delete($id)
    {
        $data = Brand::findOrFail($id);
        $data->delete();
        return redirect()->route('index-brand')->with('success', 'Data berhasil dihapus.');
    }

}
