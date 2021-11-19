<?php

namespace App\Filament\Resources\ChannelResource\Pages;

use App\Filament\Resources\ChannelResource;
use Filament\Resources\Pages\Page;

class SortChannels extends Page
{
    public static $resource = ChannelResource::class;

    public static $view = 'filament.resources.channel-resource.pages.sort-channels';

    protected function viewData() {
        return []; 
    }
    
}
