<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\VehicleModel;
use App\Models\VehicleMakes;
use App\Models\VehicleModels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VehicleModelController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @param $request Request
   * @return AnonymousResourceCollection
   */
  public function index(Request $request) {
    if (!is_null($request->get('make', null))) {
      $makeIdArgument = intval($request->get('make'));
      $modelList = VehicleMakes::find($makeIdArgument)->models;
      return VehicleModel::collection($modelList);
    }
    return VehicleModel::collection(VehicleModels::all());
  }
}
