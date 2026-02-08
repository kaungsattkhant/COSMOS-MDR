<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'address',
        'is_active',
    ];

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
}
