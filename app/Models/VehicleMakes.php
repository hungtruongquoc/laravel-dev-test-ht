<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleMakes extends Model {
  protected $guarded = ['id'];

  public function models() {
    return $this->hasMany(VehicleModels::class);
  }
}
