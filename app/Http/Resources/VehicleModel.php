<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleModel extends JsonResource {
  /**
   * Transform the resource into an array.
   *
   * @param \Illuminate\Http\Request $request
   * @return array
   */
  public function toArray($request) {
//    return parent::toArray($request);
    return [
      'id' => $this->id,
      'title' => $this->title,
      'vehicle_make_id' => intval($this->vehicle_make_id),
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ];
  }
}
