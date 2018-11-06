<?php

namespace App\Http\Controllers;

use Mail;
use Validator;
use App\Message;
use App\Mail\Contact;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    private $breadcrumbs;

    /**
     * Constructor of the class!
     */
    public function __construct() {
        // Breadcrumb
        $this->breadcrumbs = collect([
          'Berichten' => '/berichten',
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
        $messages = Message::get();

        return view('app.messages.overview')->with([
          'messages' => $messages,
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
        // Set rules to validate
        $rules = [
          'contact_name' => 'required | max:190',
          'contact_mail' => 'required | max:190',
          'contact_phone' => 'required | max:190',
          'contact_message' => 'required',
        ];

        // Do validation
        $validator = Validator::make($request->all(), $rules);

        // Check if validator fails
        if ($validator->fails()) {
          $toast_message = trans('general.toast_validation_fail');

          return back()
              ->withErrors($validator)
              ->withInput()
              ->with('validation_contact_status', 'true');
        }

        $message = Message::create([
          'name' => $request->contact_name,
          'email' => $request->contact_mail,
          'phone' => $request->contact_phone,
          'message' => htmlspecialchars($request->contact_message),
        ]);

        if ($message) {
          Mail::to('info@cini.nl')->later(5, new Contact($request->all()));
        }

        return back()
            ->with('toast_status', 'true')
            ->with('toast_style', 'success')
            ->with('toast_content', 'Het bericht is met success verzonden. Er wordt zo spoedig mogelijk contact met u opgenomen.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);

        if (!empty($message)) {
          // Breadcrumb
          $this->breadcrumbs->put($message->name, '');

          return view('app.messages.show')->with([
            'breadcrumbs' => $this->breadcrumbs,
            'message' => $message,
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::find($id);

        if (!empty($message)) {
          // Delete
          $message->forceDelete();

          return redirect('berichten')
            ->with('toast_status', 'true')
            ->with('toast_style', 'success')
            ->with('toast_content', trans('general.toast_validation_success', ['item' => $message->name, 'action' => 'verwijderd']));
        } else {
          return back();
        }
    }
}
