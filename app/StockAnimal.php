<?php

namespace App;

use App\Experience;
use App\Specie;
use App\Supplier;

class StockAnimal extends DefaultModel
{
   public function specie()
   {
       return $this->belongsTo(Specie::class);
   }   

   public function supplier()
   {
       return $this->belongsTo(Supplier::class);
   }   

   public function experience()
   {
       return $this->belongsTo(Experience::class);
   }

   public function user()
   {
       return $this->belongsTo(User::class);
   }
}
