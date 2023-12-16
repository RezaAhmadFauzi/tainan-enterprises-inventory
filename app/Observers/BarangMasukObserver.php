<?php

namespace App\Observers;

use App\Models\BarangMasuk;
use Ramsey\Uuid\Uuid;

class BarangMasukObserver
{
    public function creating(BarangMasuk $model)
    {
        $model->id = Uuid::uuid4();
    }
}
