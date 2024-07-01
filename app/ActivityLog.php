<?php

namespace App;

use App\Http\Traits\HasCreatedBy;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasCreatedBy;

    const UPDATED_AT = null;
    protected $guarded = [];
    protected $dates = ['created_at'];

    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }
}
