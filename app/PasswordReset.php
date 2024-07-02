<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    const UPDATED_AT = null;
    
    protected $guarded = [];
    protected $primaryKey = 'email';
    public $incrementing = false;

    public static function createLink() {
        $createAt = now()->modify('+1 day');
        $token    = str_random(60);

        return self::updateOrCreate(
            ['email' => request('email')],
            [
                'token'      => $token,
                'created_at' => $createAt
            ]
        );
    }

    public function getResetLinkAttribute() {
        return route('password.reset', [$this->token, "email={$this->email}"]);
    }
}
