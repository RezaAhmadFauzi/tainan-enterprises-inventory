<?php

namespace App\Observers;

use App\Models\Brand;
use Ramsey\Uuid\Uuid;

class BrandObserver
{
   public function creating(Brand $model)
   {
      $model->id = Uuid::uuid4();
   }
}
