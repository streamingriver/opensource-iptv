<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Filament\Resources\PackageResource\RelationManagers;
use App\Filament\Roles;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;
use Ramsey\Uuid\Uuid;

class PackageResource extends Resource
{
    public static $icon = 'heroicon-o-collection';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\TextInput::make("name")->required(),
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make("name"),
            ])
            ->filters([
                //
            ]);
    }

    public static function relations()
    {
        return [
            
        ];
    }

    public static function routes()
    {
        return [
            Pages\ListPackages::routeTo('/', 'index'),
            Pages\CreatePackage::routeTo('/create', 'create'),
            Pages\EditPackage::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
