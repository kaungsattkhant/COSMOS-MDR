<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ItemCategory extends Model
{
    protected $fillable = ['name', 'is_active'];

    public function scopeFilter(Builder $query, array $data): Builder
    {
        return $query
            ->when(isset($data['is_active']), fn (Builder $q) => $q->where('is_active', $data['is_active']));
    }
}
