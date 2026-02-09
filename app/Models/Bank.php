<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Bank extends Model
{
    protected $fillable = ['name', 'is_active'];

    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }
    public function scopeFilter(Builder $query, array $data): Builder
    {
        return $query
            ->when(isset($data['is_active']), fn (Builder $q) => $q->where('is_active', $data['is_active']))
            ->when(!empty($data['search']), fn (Builder $q) => $q->where('name', 'like', '%' . $data['search'] . '%'));
    }
}
