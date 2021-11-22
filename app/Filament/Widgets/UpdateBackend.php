<?php

namespace App\Filament\Widgets;

use App\Service\NatsService;
use Filament\Widgets\Widget;

class UpdateBackend extends Widget
{
    public static $view = 'filament.widgets.update-backend';

    public $message = '';

    public function updateBackend() {
        $this->message = 'backend updated';

        NatsService::update();
    }
}
