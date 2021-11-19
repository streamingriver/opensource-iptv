<?php

namespace App\Filament\Resources\Channel\RelationManagers;

use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\RelationManager;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class PackageRelationManager extends RelationManager
{
    public static $primaryColumn = 'name';

    public static $relationship = 'packages';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\TextInput::make("name"),
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
}
