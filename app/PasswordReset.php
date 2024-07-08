<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    const UPDATED_AT = null;
    
    protected $guarded = [];
    protected $primaryKey = 'email';
    public $incrementing = false;

    /** Accessor */
    public function getResetLinkAttribute() {
        return route('password.reset', [
            'token' => $this->token,
            'email' => $this->email
        ]);
    }
    
    public function getIsExpiredAttribute() {
        return now()->greaterThan($this->created_at->addDay());
    }

    /** User-defined */
    public static function getData() {
        return self::where('email', request('email'))
            ->where('token', request('token'))
            ->first();
    }
}
