<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryLedgerItem extends Model
{
    use HasFactory;

    protected $table = 'inventory_ledger_items';

    protected $fillable = [
        'inventory_ledger_id',
        'item_id',
        'quantity',
    ];

    public function inventory_ledger()
    {
        return $this->belongsTo(InventoryLedger::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function scopeFilter(Builder $query, array $data): Builder
    {
        return $query
            ->when(isset($data['inventory_ledger_id']), fn (Builder $q) => $q->where('inventory_ledger_id', $data['inventory_ledger_id']))
            ->when(isset($data['item_id']), fn (Builder $q) => $q->where('item_id', $data['item_id']));
    }
}
