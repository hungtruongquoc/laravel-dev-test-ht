<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequests extends Model {
  protected $guarded = ['id'];
  protected $fillable = ['client_name', 'client_phone', 'client_email', 'vehicle_model_id', 'status', 'description'];
}
