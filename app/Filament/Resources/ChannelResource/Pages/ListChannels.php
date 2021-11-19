<?php

namespace App\Filament\Resources\ChannelResource\Pages;

use App\Filament\Resources\ChannelResource;
use Filament\Resources\Pages\ListRecords;

class ListChannels extends ListRecords
{

    public $canSort = true;
    public $sortRoute = 'sort';
    public static $sortButtonLabel = 'Sort';
    public static $resource = ChannelResource::class;
}
