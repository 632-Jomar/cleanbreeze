<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];
    public $incrementing = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                => 'string',
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = self::generateUniqueId();
        });
    }

    public static function generateUniqueId()
    {
        $count = self::count();

        do {
            $count++;
            $id = 'U-' . date('Ymd') .'-' . $count;

        } while (self::where('id', $id)->first());

        return $id;
    }

    /** Relationship */
    public function userType() {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    /** Accessor */
    public function getImageSrcAttribute() {
        $filename = $this->image_filename ?: 'user-icon.png';

        return '/storage/img-profile/' . $filename;
    }
}
