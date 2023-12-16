<?php

namespace App\Observers;

use App\Models\Barang;
use Ramsey\Uuid\Uuid;

class BarangObserver
{
    public function creating(Barang $model)
    {
        $model->id = Uuid::uuid4();
    }
}
