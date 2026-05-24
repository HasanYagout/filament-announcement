<?php

namespace HasanYagout\Announcement\Filament\Resources;

use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use HasanYagout\Announcement\Announcement;
use HasanYagout\Announcement\Filament\Resources\Pages\CreateAnnouncement;
use HasanYagout\Announcement\Filament\Resources\Pages\EditAnnouncement;
use HasanYagout\Announcement\Filament\Resources\Pages\ListAnnouncements;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                RichEditor::make('body')
                    ->required(),
                Select::make('type')
                    ->options([
                        'info' => 'Info',
                        'success' => 'Success',
                        'warning' => 'Warning',
                        'danger' => 'Danger',
                    ])
                    ->default('info'),
                Select::make('icon')
                    ->options([
                        'heroicon-o-information-circle' => 'Information',
                        'heroicon-o-check-circle' => 'Check Circle',
                        'heroicon-o-exclamation-triangle' => 'Warning',
                        'heroicon-o-x-circle' => 'Error',
                    ]),
                Select::make('target_type')
                    ->label('Recipient Model')
                    ->options(function () {
                        $options = ['App\Models\User' => 'User'];
                        // Allow users to add custom models
                        $customModels = config('announcement-plugin.custom_models', []);
                        foreach ($customModels as $modelClass) {
                            $options[$modelClass] = class_basename($modelClass);
                        }

                        return $options;
                    })
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($set) => $set('target_id', null)),
                Select::make('target_id')
                    ->label('Recipient')
                    ->options(function ($get) {
                        $type = $get('target_type');
                        if (! $type || ! class_exists($type)) {
                            return [];
                        }

                        // Dynamically fetch records from the selected model
                        return $type::pluck('name', 'id')->toArray();
                    })
                    ->required()
                    ->searchable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->searchable(),
            TextColumn::make('type')->badge(),
            TextColumn::make('target_type')
                ->formatStateUsing(fn ($state) => class_basename($state)),
            TextColumn::make('sent_at')->dateTime(),
            TextColumn::make('created_at')->dateTime(),
        ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAnnouncements::route('/'),
            'create' => CreateAnnouncement::route('/create'),
            'edit' => EditAnnouncement::route('/{record}/edit'),
        ];
    }
}
