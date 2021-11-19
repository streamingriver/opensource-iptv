<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Channel\RelationManagers\PackageRelationManager;
use App\Filament\Resources\ChannelResource\Pages;
use App\Filament\Resources\ChannelResource\RelationManagers;
use App\Filament\Roles;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;
use Ramsey\Uuid\Uuid;

class ChannelResource extends Resource
{
    public static $icon = 'heroicon-o-collection';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\TextInput::make("uuid")->default(Uuid::uuid4())->disabled(),
                Components\TextInput::make("name"),
                Components\TextInput::make("url"),
                Components\TextInput::make("stream_url"),
                Components\Checkbox::make("active"),
                // Components\BelongsToSelect::make("package_id")
                //     ->relationship("packages", "name")
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make("name")->sortable(),
            ])
            ->filters([
                // Filter::make("name"),
            ]);
    }

    public static function relations()
    {
        return [
            PackageRelationManager::class,
        ];
    }

    public static function routes()
    {
        return [
            Pages\ListChannels::routeTo('/', 'index'),
            Pages\CreateChannel::routeTo('/create', 'create'),
            Pages\EditChannel::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
