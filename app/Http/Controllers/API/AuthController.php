<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthController extends Controller {
  public function login(Request $request) {
    // taking only the credentials we need
    $creds = $request->only(['email', 'password']);
    // try to authenticate them using Laravel’s auth()->attempt() method
    if (!$token = auth()->attempt($creds)) {
      /*
       * get a null back we want to send a response back to the user with the appropriate header
       * (401: Unauthorized) letting them know that their email or password was incorrec
       * */
      return response()->json(['error' => 'Incorrect email/password'], 401);
    }
    /*
     * If the user is authenticated, a JWT is returned, and we pass that string back to the user wrapped in a
     * JSON response with a single key, token.
     * */
    return response()->json(['token' => $token]);
  }

  public function refresh() {
    try {
      $newToken = auth()->refresh();
    }
    catch(TokenInvalidException $ex) {
      /*
       * wrapped the auth()->refresh() method in a try/catch, if it’s called without a valid token
       * it’ll kick back an error saying so with the appropriate 401 header
       */
      return response()->json(['error' => $ex->getMessage()], 401);
    }
    /*
     * it’ll return back a brand new JWT wrapped in the same JSON response we get when logging in.
     * */
    return response()->json(['token' => $newToken], 200);
  }
}
