<?php

namespace App\Services;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangService
{
    /**
     * @param $apartmentId
     */
    public static function searchBarang(Request $request)
    {
        return Barang::find($request->barangId);
    }
}
