<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $casts = ['id' => 'string'];
    protected $guarded = [];
    protected $dates = ['created_at'];

    public $incrementing = false;

    public static function generateId()
    {
        $prefix = date('Ymd');
        $count  = self::whereDate('created_at', now())->count();
        $qCount = (new Quotation)->qCount($count);
        $qId    = $prefix . '-' . $qCount;

        do {
            $count++;

            $qCount = (new Quotation)->qCount($count);
            $qId    = $prefix . '-' . $qCount;

        } while (self::where('id', $qId)->first());

        return $qId;
    }

    public function qCount($count) {
        return str_pad($count, 3, 0, STR_PAD_LEFT);
    }

    public function revisionId() {
        $self  = self::where('root_id', $this->root_id);
        $count = $self->count() + 1;
        $revId = $this->root_id . '-' . $count;

        while (self::where('id', $revId)->first()) {
            $count++;

            $revId = $this->root_id . '-' . $count;
        }

        return $revId;
    }

    /** Relationship */
    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function quotationProducts() {
        return $this->hasMany(QuotationProduct::class);
    }

    public function quotationMiscs() {
        return $this->hasMany(QuotationMisc::class);
    }

    /** Accessor */
    public function getStatusAttribute() {
        // $quotation = Quotation::where('root_id', $this->root_id)->orderBy('id')->first();
        $count     = Quotation::where('root_id', $this->root_id)->count();
        $class     = 'danger';

        if ($this->is_approved) {
            $class  = 'primary';
            $status = 'APPROVED QUOTE';
        }
        else if ($count > 1) {
            if ($this->id == $this->root_id /** || $this->id == $quotation->id*/ ) {
                $class  = 'warning';
                $status = 'NEW QUOTATION CREATED';

            } else {
                $status = auth()->user()->user_type_id == 2
                    ? 'WAITING FOR APPROVAL'
                    : 'PENDING';
            }

        } else {
            $status = auth()->user()->user_type_id == 2
                ? 'WAITING FOR APPROVAL'
                : 'PENDING';
        }

        return "<p class='text-wrap badge badge-$class m-0 p-2'>
            $status
        </p>";
    }

    public function getIsApprovedAttribute() {
        return !!$this->approved_at;
    }

    public function getHasApprovedAttribute() {
        return Quotation::where('root_id', $this->root_id)->where('approved_at', '<>', null)->count();
    }

    public function getTotalProductCostAttribute() {
        return $this->quotationProducts->sum('total_product_price');
    }

    public function getTotalOtherChargesAttribute() {
        return $this->labor_cost + $this->material_cost + $this->mobilization + $this->other_install + $this->delivery_fee + $this->quotationMiscs->sum('price');
    }

    public function getSubtotalAttribute() {
        return $this->total_product_cost + $this->total_other_charges;
    }

    public function getVatAttribute() {
        return $this->is_vat
            ? ($this->subtotal - $this->discount) * 0.12
            : 0;
    }

    public function getTotalAttribute() {
        return $this->subtotal + $this->vat - $this->discount;
    }

    public function getGrandTotalAttribute() {
        return $this->payment_method == 'Credit Card Online Payment'
            ? $this->total + ($this->total * 0.04)
            : $this->total;
    }

    public function getExpirationDateAttribute() {
        return $this->created_at->modify('+1 month');
    }

    /** User-defined */
    public static function paginatedRecords() {
        $results = self::where('id', 'like', '%' . request('search') . '%')
            ->orWhere('name', 'like', '%' . request('search') . '%')
            ->orWhereHas('createdBy', function($query) {
                $query->where('name', 'like', '%'. request('search') . '%');
            })
            ->orderBy('id', 'DESC')
            ->paginate(10);

        $results->appends([
            'search' => request('search')
        ]);

        return $results;
    }
}
