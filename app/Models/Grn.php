<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grn extends Model
{
    //
    protected $fillable = [
        'purchase_order_id',
        'supplier_id',
        'grn_date',
        'status',
        'received_by',
        'remark'
    ];
    //
    public function purchase_order()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
    //
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function grn_items()
    {
        return $this->hasMany(GrnItem::class);
    }
}
