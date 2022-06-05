<?php

namespace Dealskoo\Contact\Http\Controllers;

use Dealskoo\Contact\Events\ContactCreated;
use Dealskoo\Contact\Mail\ContactMail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function handle(Request $request)
    {
        $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'title' => ['required'],
            'message' => ['required']
        ]);

        event(new ContactCreated($request->first_name, $request->last_name, $request->email, $request->title, $request->message));

        Mail::to(config('mail.reply_to.address'))->send(new ContactMail($request->first_name, $request->last_name, $request->email, $request->title, $request->message));

        if ($request->ajax()) {
            return ['success' => __('Thank you contact us!')];
        } else {
            return back()->with('success', __('Thank you contact us!'));
        }
    }
}
