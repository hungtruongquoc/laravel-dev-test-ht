<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequestHttpRequest;
use App\Http\Requests\ServiceRequestUpdateHttpRequest;
use App\Models\VehicleMakes;
use Illuminate\Http\Request;
use App\Models\ServiceRequests;
use Illuminate\Support\Facades\Route;

class ServiceRequestsController extends Controller{
  /**
   * [Display a paginated list of Service Requests in the system]
   * @param $request Request Request object
   * @return view
   */
  public function index(Request $request) {
    $query = $query = ServiceRequests::orderBy('updated_at', 'desc');
    $searchText = null;
    if ($request->has('search')) {
      $searchText = $request->input('search');
      $query->orWhere('description', 'LIKE', "%{$searchText}%")
            ->orWhere('client_phone', 'LIKE', "%{$searchText}%")
            ->orWhere('client_email', 'LIKE', "%{$searchText}%")
            ->orWhere('status', 'LIKE', "%{$searchText}%")
            ->orWhere('client_name', 'LIKE', "%{$searchText}%");
    }
    $requests = $query->paginate(20);
    $currentRouteName = Route::currentRouteName();
    return view('index', compact('requests', 'searchText', 'currentRouteName'));
  }

  /**
   * [This is the method you should use to show the edit screen]
   * @param string $id [get the object you are planning on editing]
   * @return ...
   */
  public function edit($id) {
    $makes = json_encode(VehicleMakes::select(['id', 'title'])->get());
    // Encodes the data into json so that the front end can pick up and load into the form
    $currentRequest = json_encode(ServiceRequests::with('vehicleModel')->find($id));
    $requestId = $id;
    $currentRouteName = Route::currentRouteName();
    return view('create', compact('makes','currentRequest', 'requestId', 'currentRouteName'));
  }

  /**
   * Show the create service request form
   */
  public function create() {
    $makes = json_encode(VehicleMakes::select(['id', 'title'])->get());
    $status = 'new';
    $currentRouteName = Route::currentRouteName();
    return view('create', compact('makes', 'status', 'currentRouteName'));
  }

  /**
   * Create a new service request
   *
   * @param ServiceRequestHttpRequest $request
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function store(ServiceRequestHttpRequest $request) {
    $arguments = $request->validated();
    $arguments['status'] = 'new';
    try {
      $newRequest = ServiceRequests::create($arguments);
      if (!is_null($newRequest) && !is_null($newRequest->id)) {
        return redirect('/')->with('createStatus', 'New service request created successfully!');
      }
      return redirect('create')
        ->with('createStatus', 'New service request cannot be saved! Please try again later!');
    } catch (\Exception $ex) {
      return redirect('create')
        ->with('createStatus', 'New service request cannot be saved! Please try again later!');
    }
  }

  /**
   * Update an existing service request
   *
   * @param ServiceRequestUpdateHttpRequest $request
   * @param $id
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function update(ServiceRequestUpdateHttpRequest $request, $id) {
    $currentRequest = ServiceRequests::find($id);
    try {
      $currentRequest->update($request->validated());
      return redirect('/')->with('updateStatus', 'The service request is updated successfully!');
    } catch (\Exception $ex) {
      return redirect('create')
        ->with('updateStatus', 'The service request cannot be updated! Please try again later!');
    }
  }
}
