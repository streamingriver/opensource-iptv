<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function channels()
    {
        return $this->belongsToMany(Channel::class, 'channels_packages', 'package_id', 'channel_id', 'id', 'id');
    }
}
