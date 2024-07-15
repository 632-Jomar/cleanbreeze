<?php

namespace App\Http\Controllers;

use App\ActivityLog;
use App\User;
use App\UserType;
use App\VerificationToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('userType:1');
    }

    public function getAllUsers() {
        return User::orderBy('user_type_id')->orderBy('name')->get();
    }

    public function index() {
        $users     = $this->getAllUsers();
        $userTypes = UserType::all();

        return view('accounts.index', compact('users', 'userTypes'));
    }

    public function store() {
        DB::beginTransaction();

        $this->validate(request(), [
            'name'         => 'required|string',
            'email'        => 'required|email|unique:users,email',
            'user_type_id' => 'required|exists:user_types,id'
        ]);

        try {
            $password = uniqid();

            $user = User::create([
                'name'           => request('name'),
                'email'          => request('email'),
                'user_type_id'   => request('user_type_id'),
                'contact_number' => request('contact_number'),
                'password'       => Hash::make($password),
            ]);

            $verificationToken = VerificationToken::create([
                'email'      => $user->email,
                'token'      => str_random(60),
                'created_at' => now()
            ]);

            ActivityLog::create([
                'entity_id'   => $user->id,
                'entity_type' => 'User',
                'description' => 'User account created by admin'
            ]);

            Mail::send('email.users.verification', compact('verificationToken'), function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Account Verification');
            });

            $users = $this->getAllUsers();
            DB::commit();

            return response([
                'view'    => view('accounts.tbody', compact('users'))->render(),
                'message' => 'Account has been created successfully.'
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function resend(User $user) {
        DB::beginTransaction();

        try {
            $verificationToken = VerificationToken::updateOrCreate(
                ['email' => $user->email],
                ['token' => str_random(60), 'created_at' => now()]
            );

            ActivityLog::create([
                'entity_id'   => $user->id,
                'entity_type' => 'User',
                'description' => 'User activation link resend by admin'
            ]);

            Mail::send('email.users.verification', compact('verificationToken'), function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Account Verification');
            });

            $users = $this->getAllUsers();
            DB::commit();

            return response([
                'view'    => view('accounts.tbody', compact('users'))->render(),
                'message' => 'New verification link was sent successfully.'
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
