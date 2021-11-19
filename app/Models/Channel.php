<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    public function scopeUUID($builder, $uuid) {
        return $builder->where("uuid", $uuid);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'channels_packages', 'channel_id', 'package_id', 'id', 'id');
    }
}
