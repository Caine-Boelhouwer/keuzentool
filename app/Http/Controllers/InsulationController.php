<?php

namespace App\Http\Controllers;

use Validator;
use Image;
use File;
use App\Helper;
use App\Insulation;
use Illuminate\Http\Request;

class InsulationController extends Controller
{
    private $breadcrumbs;

    /**
     * Constructor of the class
     */
    public function __construct() {
        // Breadcrumb
        $this->breadcrumbs = collect([
          'Isolatie' => '/isolatie',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all itmes
        $insulations = Insulation::get();

        return view('app.insulations.overview')->with([
          'insulations' => $insulations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Breadcrumb
        $this->breadcrumbs->put('Aanmaken', '');

        return view('app.insulations.create')->with([
          'breadcrumbs' => $this->breadcrumbs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Set rules to validate
        $rules = [
          'name' => 'required | max:190',
          'max_temp' => 'required | max:190',
          'min_temp' => 'required | max:190',
          'location' => 'required | max:190',
          'insulation_mat' => 'required | max:190',
          'insulation_spec' => 'required | max:190',
          'finish_mat' => 'required | max:190',
          'finish_spec' => 'required | max:190',
          'description' => 'required | max:190',
          'explanation' => 'required | max:190',
          'chapter' => 'required | max:190',
          'image' => 'image | max:2048',
        ];

        // Do validation
        $validator = Validator::make($request->all(), $rules);

        // Check if validator fails
        if ($validator->fails()) {
          $toast_message = trans('general.toast_validation_fail');

          if ($validator->messages()->first('image')) {
            $toast_message .= trans('general.toast_validation_image_fail', ['max' => 2048]);
          }

          return redirect('isolatie/aanmaken')
              ->withErrors($validator)
              ->withInput()
              ->with('toast_status', 'true')
              ->with('toast_style', 'alert')
              ->with('toast_content', $toast_message);
        }

        $insulation = Insulation::create([
          'status' => $request->status,
          'name' => $request->name,
          'max_temp' => $request->max_temp,
          'min_temp' => $request->min_temp,
          'location' => $request->location,
          'insulation_mat' => $request->insulation_mat,
          'insulation_spec' => $request->insulation_spec,
          'finish_mat' => $request->finish_mat,
          'finish_spec' => $request->finish_spec,
          'description' => htmlspecialchars($request->description),
          'explanation' => htmlspecialchars($request->explanation),
          'chapter' => $request->chapter,
        ]);

        // rename and crop image
        if (isset($request->image)) {
          $path = public_path('/uploads/insulation');
          $image_file_name = time().'_'.snake_case($request->image->getClientOriginalName());
          $img = Image::make($request->image->getRealPath());
          $img->fit(650, 650)->save($path.'/'.$image_file_name);
          $insulation->image = $image_file_name;
          $insulation->save();
        }

        return redirect('isolatie')
          ->with('toast_status', 'true')
          ->with('toast_style', 'success')
          ->with('toast_content', trans('general.toast_validation_success', ['item' => $insulation->name, 'action' => 'aangemaakt']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $insulation = Insulation::find($id);

        if (!empty($insulation)) {
          // Breadcrumb
          $this->breadcrumbs->put($insulation->name, '');

          return view('app.insulations.show')->with([
            'breadcrumbs' => $this->breadcrumbs,
            'insulation' => $insulation,
          ]);
        } else {
          return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $insulation = Insulation::find($id);

        if (!empty($insulation)) {
          // Breadcrumb
          $this->breadcrumbs->put($insulation->name, '/isolatie/'.$insulation->id);
          $this->breadcrumbs->put('Bewerken', '');

          return view('app.insulations.edit')->with([
            'insulation' => $insulation,
            'breadcrumbs' => $this->breadcrumbs,
          ]);
        } else {
          return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $insulation = Insulation::find($id);

        if (!empty($insulation)) {
          // Set rules to validate
          $rules = [
            'name' => 'required | max:190',
            'max_temp' => 'required | max:190',
            'min_temp' => 'required | max:190',
            'location' => 'required | max:190',
            'insulation_mat' => 'required | max:190',
            'insulation_spec' => 'required | max:190',
            'finish_mat' => 'required | max:190',
            'finish_spec' => 'required | max:190',
            'description' => 'required',
            'explanation' => 'required',
            'chapter' => 'required | max:190',
            'image' => 'image | max:2048',
          ];

          // Do validation
          $validator = Validator::make($request->all(), $rules);

          // Check if validator fails
          if ($validator->fails()) {
            $toast_message = trans('general.toast_validation_fail');

            if ($validator->messages()->first('image')) {
              $toast_message .= trans('general.toast_validation_image_fail', ['max' => 2048]);
            }

            return redirect('isolatie/bewerken/'.$insulation->id)
                ->withErrors($validator)
                ->withInput()
                ->with('toast_status', 'true')
                ->with('toast_style', 'alert')
                ->with('toast_content', $toast_message);
          }

          // rename, crop and replace image
          if (isset($request->image)) {
            $path = public_path('/uploads/insulation');

            if ($insulation->image != 'no_image.png') {
              File::delete($path.'/'.$insulation->image);
            }

            $image_file_name = time().'_'.snake_case($request->image->getClientOriginalName());
            $img = Image::make($request->image->getRealPath());
            $img->fit(650, 650)->save($path.'/'.$image_file_name);
            $insulation->image = $image_file_name;
          }

          // Update data
          $insulation->status = $request->status;
          $insulation->name = $request->name;
          $insulation->max_temp = $request->max_temp;
          $insulation->min_temp = $request->min_temp;
          $insulation->location = $request->location;
          $insulation->insulation_mat = $request->insulation_mat;
          $insulation->insulation_spec = $request->insulation_spec;
          $insulation->finish_mat = $request->finish_mat;
          $insulation->finish_spec = $request->finish_spec;
          $insulation->description = htmlspecialchars($request->description);
          $insulation->explanation = htmlspecialchars($request->explanation);
          $insulation->chapter = $request->chapter;
          $insulation->save();

          return redirect('isolatie/'.$insulation->id)
            ->with('toast_status', 'true')
            ->with('toast_style', 'success')
            ->with('toast_content', trans('general.toast_validation_success', ['item' => $insulation->name, 'action' => 'geupdate']));
        } else {
          return back();
        }
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $insulation = Insulation::onlyTrashed()->find($id);

        if (!empty($insulation)) {
          // Restore data
          $insulation->restore();

          return redirect('isolatie/archief')
            ->with('toast_status', 'true')
            ->with('toast_style', 'success')
            ->with('toast_content', trans('general.toast_validation_success', ['item' => $insulation->name, 'action' => 'hersteld']));
        } else {
          return back();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function archive()
    {
        $insulations = Insulation::onlyTrashed()->get();

        return view('app.insulations.archive')->with([
          'insulations' => $insulations,
        ]);
    }

    /**
     * Archive the specified resources from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkArchive(Request $request)
    {
        $amount = count($request->id);

        foreach ($request->id as $id) {
          $insulation = Insulation::find($id);
          $insulation->delete();
        }

        $toast_text = $amount == 1 ? 'Object' : 'Objects';

        return redirect('isolatie')
          ->with('toast_status', 'true')
          ->with('toast_style', 'success')
          ->with('toast_content', trans('general.toast_validation_success', ['item' => $toast_text, 'action' => 'gearchiveerd']));
    }

    /**
     * Archive the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function archiving($id)
    {
        $insulation = Insulation::find($id);

        if (!empty($insulation)) {
          $insulation->delete();

          return redirect('isolatie')
            ->with('toast_status', 'true')
            ->with('toast_style', 'success')
            ->with('toast_content', trans('general.toast_validation_success', ['item' => $insulation->name, 'action' => 'gearchiveerd']));

        } else {
          return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $insulation = Insulation::onlyTrashed()->find($id);

        if (!empty($insulation)) {
          // Delete image
          $path = public_path('/uploads/insulation');
          if ($insulation->image != 'no_image.png') {
            File::delete($path.'/'.$insulation->image);
          }

          // Delete
          $insulation->forceDelete();

          return redirect('isolatie/archief')
            ->with('toast_status', 'true')
            ->with('toast_style', 'success')
            ->with('toast_content', trans('general.toast_validation_success', ['item' => $insulation->name, 'action' => 'verwijderd']));
        } else {
          return back();
        }
    }
}
