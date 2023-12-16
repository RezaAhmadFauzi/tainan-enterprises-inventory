<?php

namespace App\Observers;

use App\Models\BarangKeluar;
use Ramsey\Uuid\Uuid;

class BarangKeluarObserver
{
    public function creating(BarangKeluar $model)
    {
        $model->id = Uuid::uuid4();
    }
}
