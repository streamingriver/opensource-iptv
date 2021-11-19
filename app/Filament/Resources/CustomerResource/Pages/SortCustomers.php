<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Resources\Pages\Page;

class SortCustomers extends Page
{
    public static $resource = CustomerResource::class;

    public static $view = 'filament.resources.customer-resource.pages.sort-customers';
}
