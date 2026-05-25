<?php

namespace HasanYagout\Announcement\Filament\Resources;

use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use HasanYagout\Announcement\Enums\AnnouncementType;
use HasanYagout\Announcement\Filament\Resources\Pages\CreateAnnouncement;
use HasanYagout\Announcement\Filament\Resources\Pages\EditAnnouncement;
use HasanYagout\Announcement\Filament\Resources\Pages\ListAnnouncements;
use HasanYagout\Announcement\Models\Announcement;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;
    public static function getNavigationLabel(): string
    {
        return __('announcements::filament.navigation.plural');
    }
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedMegaphone;
    public static function getModelLabel(): string
    {
        return __('announcements::filament.navigation.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('announcements::filament.navigation.plural');
    }
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Section::make(__('announcements::filament.sections.announcement'))
                    ->schema([
                        TextInput::make('title')
                            ->label(__('announcements::filament.form.title.label'))
                            ->required()
                            ->columnSpan(3)
                            ->maxLength(255),

                        RichEditor::make('body')
                            ->label(__('announcements::filament.form.body.label'))
                            ->required()
                            ->columnSpanFull(),




                        Select::make('type')
                            ->label(__('announcements::filament.form.type.label'))
                            ->options(
                                collect(AnnouncementType::cases())
                                    ->mapWithKeys(fn (AnnouncementType $type) => [
                                        $type->value => $type->label(),
                                    ])
                            )
                            ->required()
                            ->native(false),
                        DateTimePicker::make('starts_at')
                            ->label(__('announcements::filament.form.starts_at.label')),

                        DateTimePicker::make('ends_at')
                            ->label(__('announcements::filament.form.ends_at.label')),
                        Toggle::make('is_active')
                            ->label(__('announcements::filament.form.is_active.label'))
                            ->default(true),

                        Toggle::make('is_dismissible')
                            ->label(__('announcements::filament.form.is_dismissible.label'))
                            ->default(true),

                        Toggle::make('is_global')
                            ->label(__('announcements::filament.form.is_global.label'))
                            ->live(),
                    ])
                    ->columns(3),

                Section::make(__('announcements::filament.sections.recipients'))
                    ->hidden(fn (Get $get) => $get('is_global'))
                    ->schema([
                        Select::make('recipient_type')
                            ->label(__('announcements::filament.form.recipient_type.label'))
                            ->live()
                            ->options(
                                collect(config('announcement.recipient_models'))
                                    ->mapWithKeys(fn ($config, $class) => [
                                        $class => $config['label'],
                                    ])
                                    ->toArray()
                            )
                            ->required(),

                        Select::make('recipient_ids')
                            ->multiple()
                            ->options(function (Get $get) {

                                $model = $get('recipient_type');

                                if (! $model) {
                                    return [];
                                }

                                $config = config("announcement.recipient_models.{$model}");

                                if (! $config) {
                                    return [];
                                }

                                $titleAttribute = $config['title_attribute'];

                                return $model::query()
                                    ->get()
                                    ->mapWithKeys(fn ($record) => [
                                        $record->id => $record->{$titleAttribute},
                                    ])
                                    ->toArray();
                            }),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')
                ->label(__('announcements::filament.table.columns.title'))
                ->searchable()
                ->sortable(),
            TextColumn::make('recipient_labels')
                ->label(__('announcements::filament.table.columns.recipients'))
                ->badge()
                ->state(function ($record) {

                    if ($record->is_global) {
                        return 'Everyone';
                    }

                    return $record->recipients
                        ->map(function ($recipient) {
                            return class_basename($recipient->recipient_type);
                        })
                        ->unique()
                        ->join(', ');
                }),

            IconColumn::make('is_active')
                ->label(__('announcements::filament.table.columns.is_active'))
                ->boolean(),

            TextColumn::make('starts_at')
                ->label(__('announcements::filament.table.columns.starts_at'))
                ->dateTime(),

            TextColumn::make('ends_at')
                ->label(__('announcements::filament.table.columns.ends_at'))
                ->dateTime(),

            TextColumn::make('created_at')
                ->label(__('announcements::filament.table.columns.created_at'))
                ->since(),
        ])
            ->modifyQueryUsing(fn ($query) => $query->with('recipients'))
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
