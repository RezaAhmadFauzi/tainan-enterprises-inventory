<?php

namespace App\Observers;

use App\Models\Atribut;
use Ramsey\Uuid\Uuid;

class AtributObserver
{
    public function creating(Atribut $model)
    {
        $model->id = Uuid::uuid4();
    }
}
