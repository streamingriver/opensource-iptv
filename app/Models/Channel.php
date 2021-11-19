<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();
        
        static::addGlobalScope('default_order_by', function (Builder $builder) {
            $builder->orderBy('pos', 'asc');
        });
    }

    public function scopeUUID($builder, $uuid)
    {
        return $builder->where("uuid", $uuid);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'channels_packages', 'channel_id', 'package_id', 'id', 'id');
    }
}
