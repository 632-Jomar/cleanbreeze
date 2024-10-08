<?php

namespace App\Http\Controllers;

use App\ActivityLog;
use App\Http\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    use ImageTrait;

    protected $folderName = 'img-profile';

    public function __construct()
    {
        $this->middleware('userType:1,2');
    }

    public function index() {
        return view('users.index');
    }

    public function updateInfo() {
        DB::beginTransaction();

        $this->validate(request(), [
            'name'  => 'required|string',
            'email' => 'required|email'
        ]);

        try {
            $user        = auth()->user();
            $user->name  = request('name');
            $user->email = request('email');

            if ($user->isDirty()) {
                $user->save();

                ActivityLog::create([
                    'entity_id'   => $user->id,
                    'entity_type' => 'User',
                    'description' => 'User details updated'
                ]);

                DB::commit();

                return response([
                    'message' => 'Your profile info has been updated successfully.'
                ]);
            }

            abort(422, 'No changes were made');

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function updatePassword() {
        $this->validate(request(), [
            'password' => 'required|confirmed|min:8|max:16'
        ]);

        try {
            $user = auth()->user();

            if (! Hash::check(request('old_password'), $user->password))
                abort(403, 'Incorrect old password');

            if (request('old_password') != request('password')) {
                ActivityLog::create([
                    'entity_id'   => $user->id,
                    'entity_type' => 'User',
                    'description' => 'User password updated'
                ]);

                $user->update([
                    'password' => Hash::make(request('password')),
                ]);

            } else {
                abort(422, 'No changes were made');
            }

            return response([
                'message' => 'Your password has been updated successfully.'
            ]);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function uploadImage() {
        try {
            $filename = $this->saveImageBase64ToPng($this->folderName, auth()->user()->image_filename, request('image_profile'), 'PRF-');

            auth()->user()->update([
                'image_filename' => $filename
            ]);

            return response([
                'message' => 'Image has been uploaded successfully',
                'src'     => auth()->user()->image_src
            ]);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function removeImage() {
        try {
            abort_unless(auth()->user()->image_filename, 404, 'No image found');

            $this->deleteImage($this->folderName, auth()->user()->image_filename);

            auth()->user()->update([
                'image_filename' => null
            ]);

            return response([
                'message' => 'Image has been uploaded successfully',
                'src'     => auth()->user()->image_src
            ]);

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
