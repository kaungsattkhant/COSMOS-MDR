<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'description',
        'uom_id',
        'is_active',
        'item_category_id',
    ];

    public function item_category()
    {
        return $this->belongsTo(ItemCategory::class, 'item_category_id');
    }

     public function uom()
    {
        return $this->belongsTo(Uom::class, 'uom_id');
    }

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

    public function scopeFilter(Builder $query, array $data): Builder
    {
        return $query
            ->when(isset($data['is_active']), fn (Builder $q) => $q->where('is_active', $data['is_active']))
            ->when(!empty($data['search']), fn (Builder $q) => $q->where(function (Builder $q) use ($data) {
                $q->where('name', 'like', '%' . $data['search'] . '%')
                    ->orWhere('code', 'like', '%' . $data['search'] . '%');
            }));
    }
}
