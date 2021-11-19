<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'token'];

    public function scopeURL($builder, $uuid) {
        return $builder->where("uuid", $uuid)->orWhere("short_url", $uuid);
    }

    public function channels() {
        return $this->belongsToMany(Channel::class, 'channels_packages', 'package_id', 'channel_id', 'package_id', 'id');
    }

    public function packages() {
        return $this->belongsTo(Package::class, 'package_id', "id");
    }
}

