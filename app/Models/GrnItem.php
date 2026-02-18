<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GrnItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_order_id',
        'purchase_order_item_id',
        'date_time',
        'supplier_id',
        'item_id',
        'qty_received',
        'remark',
        'status',
        'received_by',
        'received_at',
        'confirmed_by',
        'confirmed_at',
        'cancelled_by',
        'cancelled_at',
    ];
    
    protected $casts = [
        'date_time' => 'datetime',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function purchase_order_item()
    {
        return $this->belongsTo(PurchaseOrderItem::class);
    }
    public function purchase_order()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function received()
    {
        return $this->belongsTo(User::class, 'received_by');
    }
}
