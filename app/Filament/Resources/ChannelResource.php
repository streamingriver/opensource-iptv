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
use Filament\Tables\RecordActions\Link;
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
                Components\TextInput::make("stream_url"),
                Components\Select::make("ffmpeg")->options([
                    '0' => 'Disabled',
                    '1' => 'Enabled',
                ])->label("Use ffmpeg for stream_url"),
                Components\Select::make("active")->options([
                    '0' => 'Disabled',
                    '1' => 'Enabled',
                ]),
                // Components\Checkbox::make("ffmpeg")->label("meh"),
                // Components\Checkbox::make("active"),
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make("name")->sortable()->searchable(),
            ])
            ->filters([
                // Filter::make("name"),
            ]); //->prependRecordActions([
                // Link::make('view')->url(fn ($record) => static::generateUrl('sort', ['record' => $record])),
            // ]);;
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
            Pages\SortChannels::routeTo('/sort', 'sort'),
        ];
    }
}
