<?php

namespace App;

use App\Http\Traits\HasCreatedBy;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasCreatedBy;
    use Notifiable;
    use SoftDeletes;

    const SUPER_ADMINS = ['632apps@gmail.com', 'jalarcon.632apps@gmail.com'];

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

    public function verificationToken() {
        return $this->hasOne(VerificationToken::class, 'email', 'email');
    }

    public function quotations() {
        return $this->hasMany(Quotation::class, 'created_by');
    }

    public function approvedQuotations() {
        return $this->hasMany(Quotation::class, 'created_by')->where('approved_at', '<>', null);
    }

    public function revisedQuotations() {
        return $this->hasMany(Quotation::class, 'created_by')->where('revised_by', '<>', null);
    }

    /** Accessor */
    public function getCanDeleteAttribute() {
        return !in_array($this->email, self::SUPER_ADMINS);
    }

    public function getImageSrcAttribute() {
        $filename = $this->image_filename ?: 'user-icon.png';

        return '/storage/img-profile/' . $filename;
    }

    public function getIsVerifiedAttribute() {
        return !!$this->email_verified_at;
    }

    public function getIsExpiredAttribute() {
        if ($this->is_verified)
            return false;

        return now()->greaterThan($this->created_at->addDay());
    }

    public function getStatusAttribute() {
        if ($this->email_verified_at) {
            $class  = 'success';
            $status = 'VERIFIED';

        } else {
            $class  = 'danger';
            $status = 'EXPIRED';

            if ($this->verificationToken && !$this->verificationToken->is_expired) {
                $class  = 'warning';
                $status = 'PENDING';
            }
        }

        return "<p class='d-block text-wrap badge badge-$class m-0 p-2'>
            $status
        </p>";
    }
}
