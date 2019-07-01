<?php

namespace App\Http\Controllers\API;

use App\Models\ServiceRequests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceRequestsController extends Controller{
  public function destroy($id) {
    $currentRequest = ServiceRequests::find($id);
    if (!is_null($currentRequest)) {
      $currentRequest->delete();
      return response()->json($currentRequest, 200);
    }
    return response()->json(['message' => 'No request found'], 404);
  }
}
