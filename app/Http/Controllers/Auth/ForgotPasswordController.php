<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\PasswordReset;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email'
        ], [
            'exists' => trans('passwords.user')
        ]);

        try {
            $passwordReset = PasswordReset::createLink();

            Mail::send('email.users.reset-password', compact('passwordReset'), function ($message) {
                $message->to(request('email'));
                $message->subject('Reset Password');
            });

            return $this->sendResetLinkResponse($request, 'passwords.sent');

        } catch (\Throwable $th) {
            throw $th;
        }
        
        // $user = User::where('email', request('email'))->first();

        
    }
}
