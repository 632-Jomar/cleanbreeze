<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerificationToken extends Model
{
    const UPDATED_AT = null;

    protected $primaryKey = 'email';
    protected $fillable = ['email', 'token', 'created_at'];
    protected $dates = ['created_at'];

    public $incrementing = false;

    /** Accessor */
    public function getIsExpiredAttribute() {
        return now()->greaterThan($this->created_at->addDay());
    }

    public function getVerificationLinkAttribute() {
        return route('users.verification', [
            'token' => $this->token,
            'email' => $this->email
        ]);
    }

    /** User-defined */
    public static function getData() {
        return self::where('email', request('email'))
            ->where('token', request('token'))
            ->first();
    }
}
