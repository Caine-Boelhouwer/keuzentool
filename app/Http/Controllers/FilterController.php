<?php

namespace App\Http\Controllers;

use Validator;
use App\Location;
use App\Insulation;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return view('app.filter.search');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function results($ambient_temp, $max_temp, $min_temp, $location)
    {
        $input_location = Location::find($location);

        if ($input_location) {
          if ($ambient_temp >= 20) {
            $insulation = Insulation::orderBy('max_temp')->where('max_temp', '>=', $max_temp)->where('location_id', '=', $location)->first();
          } else {
            $insulation = Insulation::orderBy('min_temp', 'desc')->where('min_temp', '<=', $min_temp)->where('location_id', '=', $location)->first();
          }

          return view('app.filter.results')
              ->with('ambient_temp', $ambient_temp)
              ->with('max_temp', $max_temp)
              ->with('min_temp', $min_temp)
              ->with('insulation', $insulation)
              ->with('location', $input_location);
        } else {
          return redirect('/');
        }
    }

    /**
     * Redirect to results page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function request(Request $request)
    {
        // Set rules to validate
        $rules = [
          'ambient_temp' => 'required | max:190',
          'max_temp' => 'required | max:190',
          'min_temp' => 'required | max:190',
          'location' => 'required | not_in:default',
        ];

        // Do validation
        $validator = Validator::make($request->all(), $rules);

        // Check if validator fails
        if ($validator->fails()) {
          $toast_message = trans('general.toast_validation_fail');

          return back()
              ->withErrors($validator)
              ->withInput();
        }

        return redirect('zoeken/'.$request->ambient_temp.'/'.$request->max_temp.'/'.$request->min_temp.'/'.$request->location);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
}
