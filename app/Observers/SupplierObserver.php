<?php

namespace App\Observers;

use App\Models\Supplier;
use Ramsey\Uuid\Uuid;

class SupplierObserver
{
    public function creating(Supplier $model)
    {
        $model->id = Uuid::uuid4();
    }
}
