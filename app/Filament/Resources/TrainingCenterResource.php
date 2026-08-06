<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingCenterResource\Pages;
use App\Models\TrainingCenter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class TrainingCenterResource extends Resource
{
    use Translatable;

    protected static ?string $model = TrainingCenter::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationLabel = 'Training Centres';

    protected static ?string $modelLabel = 'training centre';

    protected static ?string $pluralModelLabel = 'training centres';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Centre details')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Location')
                        ->required()
                        ->helperText('The place, e.g. “Deralakatte” or “Kankanady, Mangaluru”.')
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state)))
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->helperText('Used in the page URL. Kept the same across languages.')
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('venue')
                        ->label('Venue')
                        ->helperText('e.g. “Shree Ayyappa Swamy Temple”.')
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('notes')
                        ->label('Second line (optional)')
                        ->helperText('An extra venue line, e.g. “Siddhi Vinayaka Bhajana Mandira”.')
                        ->columnSpanFull(),
                    Forms\Components\Textarea::make('address')
                        ->rows(2)
                        ->columnSpanFull(),
                ]),
            Forms\Components\Section::make('Weekly schedule')
                ->columns(3)
                ->schema([
                    Forms\Components\Select::make('day')
                        ->label('Day of the week')
                        ->options(TrainingCenter::DAYS)
                        ->native(false)
                        ->required(),
                    Forms\Components\TimePicker::make('start_time')
                        ->label('Class starts')
                        ->seconds(false)
                        ->required(),
                    Forms\Components\TimePicker::make('end_time')
                        ->label('Class ends')
                        ->seconds(false),
                ]),
            Forms\Components\Section::make('Contact & map')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('contact_name')
                        ->label('Contact person')
                        ->helperText('Leave blank to use the site-wide contact from Site Settings.'),
                    Forms\Components\TextInput::make('contact_phone')->label('Contact phone')->tel(),
                    Forms\Components\TextInput::make('map_url')
                        ->label('Google Maps link')
                        ->url()
                        ->columnSpanFull(),
                ]),
            Forms\Components\Section::make('Media & display')
                ->columns(2)
                ->schema([
                    Forms\Components\FileUpload::make('image')
                        ->image()
                        ->disk('public_root')
                        ->directory('images/training-centres')
                        ->imageEditor()
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('icon')
                        ->helperText('Icon key: pencil, palette, cube, device, star, brush.'),
                    Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                    Forms\Components\Toggle::make('is_featured')->label('Feature on homepage'),
                    Forms\Components\Toggle::make('is_published')->label('Live')->default(true),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('')->circular(),
                Tables\Columns\TextColumn::make('name')->label('Location')->searchable()->sortable()->weight('bold'),
                Tables\Columns\TextColumn::make('venue')->searchable()->wrap()->toggleable(),
                Tables\Columns\TextColumn::make('day')
                    ->badge()
                    ->formatStateUsing(fn (?string $state) => TrainingCenter::DAYS[$state] ?? '—'),
                Tables\Columns\TextColumn::make('time_label')->label('Time'),
                Tables\Columns\IconColumn::make('is_featured')->boolean()->label('Featured'),
                Tables\Columns\IconColumn::make('is_published')->boolean()->label('Live'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('day')->options(TrainingCenter::DAYS),
                Tables\Filters\TernaryFilter::make('is_published'),
                Tables\Filters\TernaryFilter::make('is_featured'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrainingCenters::route('/'),
            'create' => Pages\CreateTrainingCenter::route('/create'),
            'edit' => Pages\EditTrainingCenter::route('/{record}/edit'),
        ];
    }
}
