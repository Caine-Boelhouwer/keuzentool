<?php

namespace App\Http\Controllers;

use Validator;
use Auth;
use Image;
use File;
use App\User;
use App\Role;
use App\Helper;
use App\Connection;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $breadcrumbs;

    /**
     * Constructor of the class
     */
    public function __construct() {
        // Breadcrumb
        $this->breadcrumbs = collect([
          'System' => '',
          'Profile' => '/system/profile',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.systems.profile.show')->with([
          'breadcrumbs' => $this->breadcrumbs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $this->breadcrumbs->put('Edit', '');

        // Create roles array
        $roles = ['default' => 'Select role'] + Role::where('ranking', '>=', Auth::user()->role->ranking)->pluck('name', 'id')->toArray();

        return view('app.systems.profile.edit')->with([
          'breadcrumbs' => $this->breadcrumbs,
          'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = Auth::user()->id;

        $user = User::where('id', '=', $id)->first();

        if (!empty($user)) {
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
              $toast_message .= ' '.trans('general.toast_validation_avatar_fail', ['max' => 2048]);
            }

            return redirect('system/profile/edit')
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
          if (!empty($request->password)){
            $user->password = bcrypt($request->password);
            $user->remember_token = null;
          }
          $user->roles_id = $request->roles_id;
          $user->save();

          // Return to user
          return redirect('system/profile')
            ->with('toast_status', 'true')
            ->with('toast_style', 'success')
            ->with('toast_content', trans('general.toast_validation_success', ['item' => $user->username, 'action' => 'updated']));
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
        //
    }
}
