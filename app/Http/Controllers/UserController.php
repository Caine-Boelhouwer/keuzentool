<?php

namespace App\Http\Controllers;

use Validator;
use Auth;
use Image;
use File;
use Mail;
use App\User;
use App\Role;
use App\Helper;
use App\Mail\Resetpassword;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $breadcrumbs;

    /**
     * Constructor of the class
     */
    public function __construct() {
        // Breadcrumb
        $this->breadcrumbs = collect([
          'Systeem' => '',
          'Gebruikers' => '/systeem/gebruikers',
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
        $users = User::whereHas('role', function($role) {
          $role->whereNotIn('slug', ['sudo']);
        })->get();

        return view('app.systems.users.overview')->with([
          'users' => $users,
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

        // Create roles array
        $roles = ['default' => 'Selecteer een rol'] + Role::where('ranking', '>=', Auth::user()->role->ranking)->pluck('name', 'id')->toArray();

        return view('app.systems.users.create')->with([
          'breadcrumbs' => $this->breadcrumbs,
          'roles' => $roles,
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
          'username' => 'required | max:190',
          'roles_id' => 'required | not_in:default',
          'email' => 'required | max:190 | unique:users,email',
          'avatar' => 'image | max:2048',
          'password' => 'required | min:6',
        ];

        // Do validation
        $validator = Validator::make($request->all(), $rules);

        // Check if validator fails
        if ($validator->fails()) {
          $toast_message = trans('general.toast_validation_fail');

          if ($validator->messages()->first('email') || $validator->messages()->first('username')) {
            $toast_message .= ' '.trans('general.toast_validation_unique_fail', ['item' => 'Email']);
          }

          if ($validator->messages()->first('avatar')) {
            $toast_message .= ' '.trans('general.toast_validation_image_fail', ['max' => 2048]);
          }

          return redirect('systeem/gebruikers/create')
              ->withErrors($validator)
              ->withInput()
              ->with('toast_status', 'true')
              ->with('toast_style', 'alert')
              ->with('toast_content', $toast_message);
        }

        $user = User::create([
          'status' => $request->status,
          'roles_id' => $request->roles_id,
          'username' => $request->username,
          'email' => strtolower($request->email),
          'password' => bcrypt($request->password),
        ]);

        // rename and crop image
        if (isset($request->avatar)) {
          $path = public_path('/uploads/avatar');
          $avatar_file_name = time().'_'.snake_case($request->avatar->getClientOriginalName());
          $img = Image::make($request->avatar->getRealPath());
          $img->fit(450, 450)->save($path.'/'.$avatar_file_name);

          $user->avatar = $avatar_file_name;
          $user->save();
        }

        // Return to user
        return redirect('systeem/gebruikers')
          ->with('toast_status', 'true')
          ->with('toast_style', 'success')
          ->with('toast_content', trans('general.toast_validation_success', ['item' => $user->username, 'action' => 'aangemaakt']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', '=', $id)->whereHas('role', function($role) {
          $role->whereNotIn('slug', ['sudo']);
        })->first();

        if (!empty($user)) {
          // Breadcrumb
          $this->breadcrumbs->put($user->username, '');

          return view('app.systems.users.show')->with([
            'breadcrumbs' => $this->breadcrumbs,
            'user' => $user,
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
        $user = User::where('id', '=', $id)->whereHas('role', function($role) {
          $role->whereNotIn('slug', ['sudo']);
        })->first();

        if (!empty($user)) {
          if (Auth::user()->role->ranking < $user->role->ranking){
            // Breadcrumb
            $this->breadcrumbs->put($user->username, '/systeem/gebruikers/'.$user->id);
            $this->breadcrumbs->put('Bewerken', '');

            // Roles
            $roles = ['default' => 'Selecteer een rol'] + Role::where('ranking', '>=', Auth::user()->role->ranking)->pluck('name', 'id')->toArray();

            return view('app.systems.users.edit')->with([
              'user' => $user,
              'roles' => $roles,
              'breadcrumbs' => $this->breadcrumbs,
            ]);
          } else {
            abort(403, 'Unauthorized action.');
          }
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
        $user = User::where('id', '=', $id)->whereHas('role', function($role) {
          $role->whereNotIn('slug', ['sudo']);
        })->first();

        if (!empty($user)) {
          if (Auth::user()->role->ranking < $user->role->ranking){
            // Set rules to validate
            $rules = [
              'username' => 'required | max:190',
              'roles_id' => 'required | not_in:default',
              'email' => 'required | max:190 | unique:users,email,'.$user->id,
              'avatar' => 'image | max:2048',
            ];

            // Do validation
            $validator = Validator::make($request->all(), $rules);

            // Check if validator fails
            if ($validator->fails()) {
              $toast_message = trans('general.toast_validation_fail');

              if ($validator->messages()->first('email') || $validator->messages()->first('username')) {
                $toast_message .= ' '.trans('general.toast_validation_unique_fail', ['item' => 'Email']);
              }

              if ($validator->messages()->first('avatar')) {
                $toast_message .= ' '.trans('general.toast_validation_image_fail', ['max' => 2048]);
              }

              return redirect('systeem/gebruikers/edit/'.$user->id)
                  ->withErrors($validator)
                  ->withInput()
                  ->with('toast_status', 'true')
                  ->with('toast_style', 'alert')
                  ->with('toast_content', $toast_message);
            }

            // rename, crop and replace image
            if (isset($request->avatar)) {
              $path = public_path('/uploads/avatar');

              if ($user->avatar != 'no_avatar.jpg') {
                File::delete($path.'/'.$user->avatar);
              }

              $avatar_file_name = time().'_'.snake_case($request->avatar->getClientOriginalName());
              $img = Image::make($request->avatar->getRealPath());
              $img->fit(450, 450)->save($path.'/'.$avatar_file_name);
              $user->avatar = $avatar_file_name;
            }

            // Update data
            $user->status = $request->status;
            $user->username = $request->username;
            $user->email = strtolower($request->email);
            $user->password = bcrypt($request->password);
            $user->roles_id = $request->roles_id;
            $user->save();

            // Return to user
            return redirect('systeem/gebruikers/'.$user->id)
              ->with('toast_status', 'true')
              ->with('toast_style', 'success')
              ->with('toast_content', trans('general.toast_validation_success', ['item' => $user->username, 'action' => 'geupdate']));

          } else {
            abort(403, 'Unauthorized action.');
          }
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
        $user = User::where('id', '=', $id)->onlyTrashed()->whereHas('role', function($role) {
          $role->whereNotIn('slug', ['sudo']);
        })->first();

        if (!empty($user)) {
          if (Auth::user()->role->ranking < $user->role->ranking){
            // Restore data
            $user->restore();

            // Return to user
            return redirect('systeem/gebruikers/archief')
              ->with('toast_status', 'true')
              ->with('toast_style', 'success')
              ->with('toast_content', trans('general.toast_validation_success', ['item' => $user->username, 'action' => 'hersteld']));

          } else {
            abort(403, 'Unauthorized action.');
          }
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
        $users = User::whereHas('role', function($role) {
          $role->whereNotIn('slug', ['sudo']);
        })->onlyTrashed()->get();

        return view('app.systems.users.archive')->with([
          'users' => $users,
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
          $user = User::where('id', '=', $id)->first();
          $user->delete();
        }

        $toast_text = $amount == 1 ? 'Object' : 'Objects';

        // Return to user
        return redirect('systeem/gebruikers')
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
        $user = User::where('id', '=', $id)->whereHas('role', function($role) {
          $role->whereNotIn('slug', ['sudo']);
        })->first();

        if (!empty($user)) {
          $user->delete();

          return redirect('/systeem/gebruikers')
            ->with('toast_status', 'true')
            ->with('toast_style', 'success')
            ->with('toast_content', trans('general.toast_validation_success', ['item' => $user->username, 'action' => 'gearchiveerd']));

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
        // Get user with id but not with sudo
        $user = User::where('id', '=', $id)->onlyTrashed()->whereHas('role', function($role) {
          $role->whereNotIn('slug', ['sudo']);
        })->first();

        if (!empty($user)) {
          if (Auth::user()->role->ranking < $user->role->ranking){

            // Delete avatar
            $path = public_path('/uploads/avatar');
            if ($user->avatar != 'no_avatar.jpg') {
              File::delete($path.'/'.$user->avatar);
            }

            // Delete
            $user->forceDelete();

            // Return to user
            return redirect('systeem/gebruikers/archief')
              ->with('toast_status', 'true')
              ->with('toast_style', 'success')
              ->with('toast_content', trans('general.toast_validation_success', ['item' => $user->username, 'action' => 'verwijderd']));

          } else {
            abort(403, 'Unauthorized action.');
          }
        } else {
          return back();
        }
    }
}
