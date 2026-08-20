<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class EventResource extends Resource
{
    use Translatable;

    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationLabel = 'Events';

    protected static ?string $modelLabel = 'event';

    protected static ?string $pluralModelLabel = 'events';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('What it is')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->live(onBlur: true)
                        // Only fill the slug while creating: changing it later
                        // would break links already shared for this event.
                        ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get, ?string $state) {
                            if (blank($get('slug'))) {
                                $set('slug', Str::slug($state));
                            }
                        })
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->helperText('Used in the page URL. Kept the same across languages — avoid changing it once the event has been shared.')
                        ->columnSpanFull(),
                    Forms\Components\Select::make('kind')
                        ->label('Type')
                        ->options(Event::KINDS)
                        ->default('competition')
                        ->native(false)
                        ->required()
                        ->helperText('A competition takes entries, so the page shows a submission deadline and where to send artwork. An announcement simply reports something, and shows the date and venue instead.'),
                    Forms\Components\Textarea::make('excerpt')
                        ->rows(3)
                        ->helperText('One or two sentences. Shown on the card, under the page title, and in link previews.')
                        ->columnSpanFull(),
                    Forms\Components\RichEditor::make('body')
                        ->toolbarButtons(['bold', 'italic', 'link', 'h3', 'bulletList', 'orderedList', 'undo', 'redo'])
                        ->columnSpanFull(),
                ]),
            Forms\Components\Section::make('When & where')
                ->columns(2)
                ->schema([
                    Forms\Components\DatePicker::make('starts_at')
                        ->label('Date')
                        ->native(false)
                        ->helperText('For a competition this is the submission deadline. Leave empty for an open-ended announcement — no date is shown and it stays listed as current.'),
                    Forms\Components\DatePicker::make('ends_at')
                        ->label('Closes on (optional)')
                        ->native(false)
                        ->helperText('Only if entries close later than the date above.'),
                    Forms\Components\Textarea::make('location')
                        ->rows(5)
                        ->helperText('Line breaks are preserved on the site.')
                        ->columnSpanFull(),
                ]),
            Forms\Components\Section::make('Media & display')
                ->columns(2)
                ->schema([
                    // Uploads land beside the committed artwork in public/, so
                    // the field can see posters that shipped with the site
                    // instead of blanking them the moment the form is saved.
                    Forms\Components\FileUpload::make('image')
                        ->label('Poster')
                        ->image()
                        ->disk('public_root')
                        ->directory('images/events')
                        ->imageEditor()
                        ->helperText('Used as the page banner, the card thumbnail and the link preview.')
                        ->columnSpanFull(),
                    Forms\Components\FileUpload::make('video')
                        ->label('Video (optional)')
                        ->disk('public_root')
                        ->directory('videos')
                        ->acceptedFileTypes(['video/mp4'])
                        ->maxSize(51200)
                        ->helperText('An MP4 up to 50 MB, played on the event page. The poster above is shown before it starts.')
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('youtube_url')
                        ->label('YouTube link (optional)')
                        ->url()
                        ->placeholder('https://www.youtube.com/watch?v=�')
                        ->rule('regex:~(youtu\.be/|youtube(-nocookie)?\.com/)~')
                        ->validationMessages(['regex' => 'Paste a YouTube watch, share or Shorts link.'])
                        ->helperText('Embedded on the event page. Use this for longer footage instead of uploading a file.')
                        ->columnSpanFull(),
                    Forms\Components\Toggle::make('is_featured')->label('Feature on homepage'),
                    Forms\Components\Toggle::make('is_published')->label('Live')->default(true),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('starts_at', 'desc')
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label(''),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable()->weight('bold')->wrap(),
                Tables\Columns\TextColumn::make('kind')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn (?string $state) => Event::KINDS[$state] ?? $state),
                Tables\Columns\TextColumn::make('starts_at')
                    ->label('Date')
                    ->date('j M Y')
                    ->placeholder('No date')
                    ->sortable(),
                Tables\Columns\IconColumn::make('video')
                    ->label('Video')
                    ->boolean()
                    ->getStateUsing(fn (Event $record): bool => filled($record->video) || filled($record->youtube_url)),
                Tables\Columns\IconColumn::make('is_featured')->boolean()->label('Featured'),
                Tables\Columns\IconColumn::make('is_published')->boolean()->label('Live'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kind')->options(Event::KINDS),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
