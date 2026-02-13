<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryLedger extends Model
{
    use HasFactory;

    protected $table = 'inventory_ledgers';

    protected $fillable = [
        'inventory_id',
        'transaction_type',
        'transaction_id',
        'reference_no',
        'date_time',
        'remarks',
    ];

    protected $casts = [
        'date_time' => 'datetime',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function inventory_ledger_items()
    {
        return $this->hasMany(InventoryLedgerItem::class);
    }

    public function scopeFilter(Builder $query, array $data): Builder
    {
        return $query
            ->when(isset($data['inventory_id']), fn (Builder $q) => $q->where('inventory_id', $data['inventory_id']))
            ->when(!empty($data['transaction_type']), fn (Builder $q) => $q->where('transaction_type', $data['transaction_type']))
            ->when(!empty($data['date_from']), fn (Builder $q) => $q->whereDate('date_time', '>=', $data['date_from']))
            ->when(!empty($data['date_to']), fn (Builder $q) => $q->whereDate('date_time', '<=', $data['date_to']))
            ->when(!empty($data['search']), fn (Builder $q) => $q->where('reference_no', 'like', '%' . $data['search'] . '%'));
    }
}
