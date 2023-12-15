<?php

namespace App\Observers;

use App\Models\Kategori;
use Ramsey\Uuid\Uuid;

class KategoriObserver
{
    public function creating(Kategori $model)
     {
        $model->id = Uuid::uuid4();
     }
}
