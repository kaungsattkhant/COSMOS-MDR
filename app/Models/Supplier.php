<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'supplier_code',
        'phone_number',
        'email',
        'address',
        'bank_id',
        'bank_account_no',
        'credit_limit_amount',
        'is_active',
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function itemPrices()
    {
        return $this->hasMany(ItemSupplierPrice::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_supplier_prices')
            ->withPivot(['purchase_price', 'effective_date', 'is_active'])
            ->withTimestamps();
    }

    public function scopeFilter(Builder $query, array $data): Builder
    {
        return $query
            ->when(isset($data['is_active']), fn (Builder $q) => $q->where('is_active', $data['is_active']))
            ->when(isset($data['bank_id']), fn (Builder $q) => $q->where('bank_id', $data['bank_id']))
            ->when(!empty($data['search']), fn (Builder $q) => $q->where('name', 'like', '%' . $data['search'] . '%'));
    }
}
