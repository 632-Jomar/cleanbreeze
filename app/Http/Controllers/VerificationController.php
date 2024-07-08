<?php

namespace App\Http\Controllers;

use App\ActivityLog;
use App\User;
use App\VerificationToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VerificationController extends Controller
{
    public function showVerificationPage() {
        $verification = VerificationToken::getData();
        $user = User::where('email', request('email'))->first();

        if (! session('verified')) {
            if (! $user || ($user && $user->is_verified) || ! $verification)
                abort(404);
        }

        return view('auth.verify', compact('verification'));
    }

    public function verify() {
        DB::beginTransaction();

        $this->validate(request(), [
            'email'    => 'required|email|exists:users,email|exists:verification_tokens,email',
            'password' => 'required|string|min:8|max:16|confirmed',
        ]);

        try {
            $verification = VerificationToken::getData();

            $user = User::where('email', request('email'))->first();

            if ($verification && $user) {
                $user->update([
                    'email_verified_at' => now(),
                    'password'          => Hash::make(request('password'))
                ]);

                ActivityLog::create([
                    'entity_type' => 'User',
                    'description' => "User account activated (User ID: {$user->id})",
                    'created_by'  => $user->id
                ]);

                $verification->delete();
                DB::commit();

                return back()->with('verified', 'Your account has been verified. You can now log in using your credentials and start exploring all the features we have to offer.');
            }

            abort(404);

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
