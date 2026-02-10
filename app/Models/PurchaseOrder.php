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
        'supplier_id',
        'purchase_date',
        'reference_no',
        'total_amount',
        'status',
        'notes',
    ];

    protected $casts = [
        'purchase_date' => 'date',
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
            ->when(!empty($data['search']), fn (Builder $q) => $q->where('reference_no', 'like', '%' . $data['search'] . '%'));
    }
}