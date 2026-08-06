<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSlideResource\Pages;
use App\Models\HeroSlide;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HeroSlideResource extends Resource
{
    use Translatable;

    protected static ?string $model = HeroSlide::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Homepage';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Hero Slides';

    protected static ?string $pluralModelLabel = 'Hero Slides';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Slide content')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('eyebrow'),
                    Forms\Components\TextInput::make('heading')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\Textarea::make('subheading')
                        ->rows(2)
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('cta_label')->label('CTA label'),
                    Forms\Components\TextInput::make('cta_url')->label('CTA URL')->url(),
                ]),
            Forms\Components\Section::make('Media & display')
                ->columns(2)
                ->schema([
                    Forms\Components\FileUpload::make('image')
                        ->image()
                        ->disk('public_root')
                        ->directory('images/hero')
                        ->imageEditor()
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                    Forms\Components\Toggle::make('is_published')->default(true),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label(''),
                Tables\Columns\TextColumn::make('heading')->searchable()->sortable()->weight('bold'),
                Tables\Columns\TextColumn::make('cta_url')->label('CTA URL')->toggleable(),
                Tables\Columns\IconColumn::make('is_published')->boolean()->label('Live'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published'),
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
            'index' => Pages\ListHeroSlides::route('/'),
            'create' => Pages\CreateHeroSlide::route('/create'),
            'edit' => Pages\EditHeroSlide::route('/{record}/edit'),
        ];
    }
}
