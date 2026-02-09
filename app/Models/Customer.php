<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Customer extends Model
{
    //
    protected $fillable = ['name','phone_number','credit_limit_amount','address','is_active'];
    public function scopeFilter(Builder $query, array $data): Builder
    {
        return $query
            ->when(isset($data['is_active']), fn(Builder $q) => $q->where('is_active', $data['is_active']))
            ->when(!empty($data['search']), fn(Builder $q) => $q->where(function (Builder $q) use ($data) {
                $q->where('name', 'like', '%' . $data['search'] . '%')
                    ->orWhere('code', 'like', '%' . $data['search'] . '%');
            }));
    }
}
