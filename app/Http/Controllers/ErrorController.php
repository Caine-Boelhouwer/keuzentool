<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ErrorController extends Controller
{
  /**
   * 403 error
   *
   * @return \Illuminate\Http\Response
   */
  public function error403()
  {
      return response()->view('errors.403');
  }

  /**
   * 404 error
   *
   * @return \Illuminate\Http\Response
   */
  public function error404()
  {
      return response()->view('errors.404');
  }
}
