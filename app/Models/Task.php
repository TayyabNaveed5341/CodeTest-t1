<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();
     
        //setting default sorting
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('priority', 'asc')->latest();
        });
    }
}
