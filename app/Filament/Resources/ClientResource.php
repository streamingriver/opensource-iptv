<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Filament\Roles;
use App\Filament\Tables\Columns\ShortUrl;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;
use Ramsey\Uuid\Uuid;

class ClientResource extends Resource
{
    public static $icon = 'heroicon-o-collection';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\TextInput::make("uuid")->default(Uuid::uuid4())->disabled(),
                Components\TextInput::make("short_url")->default(\Str::random(12))->disabled(),
                Components\TextInput::make("name"),
                Components\TextInput::make("comment"),
                Components\BelongsToSelect::make("package_id")->relationship("packages", "name"),
                Components\Checkbox::make("active"),
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make("name"),
                Columns\Text::make("comment"),
                Columns\Text::make("active"),
                ShortUrl::make("short_url"),
            ])
            ->filters([
                //
            ]);
    }

    public static function relations()
    {
        return [
            //
        ];
    }

    public static function routes()
    {
        return [
            Pages\ListClients::routeTo('/', 'index'),
            Pages\CreateClient::routeTo('/create', 'create'),
            Pages\EditClient::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
