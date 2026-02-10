<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemSupplierPrice extends Model
{
    protected $fillable = [
        'item_id',
        'supplier_id',
        'price',
        'effective_date',
        'is_active',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
