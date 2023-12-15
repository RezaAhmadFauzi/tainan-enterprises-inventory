<?php

namespace App\Http\Controllers;

use App\Helpers\ArrayHelper;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
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
        $data = Supplier::paginate(10);

        return view('supplier.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('supplier.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'namaSupplier' => 'required|string|unique:suppliers,nama_supplier'
        ]);
        
        $inputs = $this->arrayHelper->snakeCaseKey($request->all());
        Supplier::create($inputs);
   
        return redirect()->route('index-supplier')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = Supplier::findOrFail($id);
        return view('supplier.edit', compact('data'));
    }

    public function update($id, Request $request)
    {
        $supplier = Supplier::findOrFail($id);
        $request->validate([
            'namaSupplier' => 'required|string|unique:suppliers,nama_supplier,' .$id
        ]);
        
        $inputs = $this->arrayHelper->snakeCaseKey($request->all());
        $supplier->update($inputs);
        return redirect()->route('index-supplier')->with('success', 'Data berhasil diubah.');
    }

    public function delete($id)
    {
        $data = Supplier::findOrFail($id);
        $data->delete();
        return redirect()->route('index-supplier')->with('success', 'Data berhasil dihapus.');
    }
}
