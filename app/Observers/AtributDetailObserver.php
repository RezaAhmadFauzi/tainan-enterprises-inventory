<?php

namespace App\Observers;

use App\Models\AtributDetail;
use Ramsey\Uuid\Uuid;

class AtributDetailObserver
{
    public function creating(AtributDetail $model)
    {
        $model->id = Uuid::uuid4();
    }
}
