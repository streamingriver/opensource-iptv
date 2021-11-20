<?php

namespace App\Filament\Resources\ChannelResource\Pages;

use App\Filament\Resources\ChannelResource;
use App\Models\Channel;
use Filament\Resources\Pages\Page;

class SortChannels extends Page
{
    public static $resource = ChannelResource::class;

    public static $view = 'filament.resources.channel-resource.pages.sort-channels';

    public function updateTaskOrder($params) { 
        foreach($params as $param) {
            Channel::where("id", $param['value'])->firstOrFail()->update(['pos'=>$param['order']]);
        }
    }

    protected function viewData() {
        return [
            'channels' => Channel::all()
        ]; 
    }
    
}
