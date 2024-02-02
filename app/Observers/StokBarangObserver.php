<?php

namespace App\Observers;

use App\Models\StokBarang;
use Ramsey\Uuid\Uuid;

class StokBarangObserver
{
   public function creating(StokBarang $model)
   {
      $model->id = Uuid::uuid4();
   }
}
