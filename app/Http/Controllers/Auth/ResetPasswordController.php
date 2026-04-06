<?php

namespace App\Http\Controllers\Auth;

use App\ActivityLog;
use App\Http\Controllers\Controller;
use App\PasswordReset;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm(Request $request, $token = null)
    {
        $passwordReset = PasswordReset::getData();

        return view('auth.passwords.reset', compact('passwordReset'));
    }

    public function reset(Request $request)
    {
        DB::beginTransaction();

        $this->validate(request(), [
            'email'    => 'required|email|exists:users,email|exists:password_resets,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $passwordReset = PasswordReset::getData();

            $user = User::where('email', request('email'))->first();

            if ($passwordReset && $user) {
                $user->update([
                    'email_verified_at' => now(),
                    'password'          => Hash::make(request('password'))
                ]);

                ActivityLog::create([
                    'entity_id'   => $user->id,
                    'entity_type' => 'User',
                    'description' => 'User password reset',
                    'created_by'  => $user->id
                ]);

                $passwordReset->delete();
                DB::commit();

                return back()->with('reset', 'Your password has been reset. You can now used your new password to login.');
            }

            abort(404);

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
