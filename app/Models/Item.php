<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'unit',
        'is_active',
    ];

    public function supplierPrices()
    {
        return $this->hasMany(ItemSupplierPrice::class);
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'item_supplier_prices')
            ->withPivot(['purchase_price', 'effective_date', 'is_active'])
            ->withTimestamps();
    }
}
