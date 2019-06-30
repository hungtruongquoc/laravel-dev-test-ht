<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequestHttpRequest;
use App\Models\VehicleMakes;
use Illuminate\Http\Request;
use App\Models\ServiceRequests;

class ServiceRequestsController extends Controller
{

  /**
   * [Display a paginated list of Service Requests in the system]
   * @return view
   */
  public function index() {
    $requests = ServiceRequests::orderBy('updated_at', 'desc')->paginate(20);
    return view('index', compact('requests'));
  }

  /**
   * [This is the method you should use to show the edit screen]
   * @param ServiceRequests $serviceRequest [get the object you are planning on editing]
   * @return ...
   */
  public function edit(ServiceRequests $serviceRequest) {

  }

  /**
   * Show the create service request form
   */
  public function create() {
    $makes = json_encode(VehicleMakes::select(['id', 'title'])->get());
    return view('create', compact('makes'));
  }

  public function store(ServiceRequestHttpRequest $request) {
    $arguments = $request->validated();
    $arguments['status'] = 'new';
    try {
      $newRequest = ServiceRequests::create($arguments);
      if (!is_null($newRequest) && !is_null($newRequest->id)) {
        return redirect('/')->with('createStatus', 'New service request created successfully!');
      }
      return redirect('create')->with('createStatus', 'New service request cannot be saved! Please try again later!');
    }
    catch(Exception $ex) {
      return redirect('create')->with('createStatus', 'New service request cannot be saved! Please try again later!');
    }
  }
}
