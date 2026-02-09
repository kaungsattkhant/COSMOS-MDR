<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = ['name', 'is_active'];

    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }
}
