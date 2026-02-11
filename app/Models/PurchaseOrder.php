<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'purchase_orders';

    protected $fillable = [
        'po_no',
        'po_invoice_no',
        'po_date',
        'supplier_id',
        'total_amount',
        'status',
        'remark',
    ];

    protected $casts = [
        'po_date' => 'datetime',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchase_order_items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function scopeFilter(Builder $query, array $data): Builder
    {
        return $query
            ->when(isset($data['supplier_id']), fn (Builder $q) => $q->where('supplier_id', $data['supplier_id']))
            ->when(!empty($data['search']), fn (Builder $q) => $q->where('po_invoice_id', 'like', '%' . $data['search'] . '%'));
    }
}