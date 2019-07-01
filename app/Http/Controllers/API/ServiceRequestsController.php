<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\ServiceRequestDeleteHttpRequest;
use App\Http\Requests\ServiceRequestHttpRequest;
use App\Models\VehicleMakes;
use Illuminate\Http\Request;
use App\Models\ServiceRequests;
use App\Http\Controllers\Controller;

class ServiceRequestsController extends Controller{
  public function destroy(ServiceRequestDeleteHttpRequest $request) {
    $validated = $request->validated();
    dd($validated);
  }
}
