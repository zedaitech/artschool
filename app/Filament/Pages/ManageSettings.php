<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $title = 'Site Settings';

    protected static ?string $navigationLabel = 'Site Settings';

    protected static string $view = 'filament.pages.manage-settings';

    /** @var array<string, mixed> */
    public ?array $data = [];

    /** Keys managed by this page. */
    protected array $keys = [
        'site_tagline',
        'contact_email', 'contact_phone', 'contact_whatsapp', 'contact_address', 'contact_hours', 'map_embed',
        'contact_person_name', 'contact_person_role',
        'social_facebook', 'social_instagram', 'social_youtube', 'social_whatsapp',
        'meta_title', 'meta_description',
        'stat_students', 'stat_years', 'stat_centers', 'stat_awards',
    ];

    public function mount(): void
    {
        $this->form->fill(Setting::map());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Contact information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('site_tagline')->columnSpanFull(),
                        TextInput::make('contact_email')->email(),
                        TextInput::make('contact_phone'),
                        TextInput::make('contact_whatsapp')->label('WhatsApp number'),
                        TextInput::make('contact_hours')->label('Opening hours'),
                        TextInput::make('contact_person_name')->label('Contact person')
                            ->helperText('Shown on the contact page, e.g. "Mr. Suresh K. Pandavarakallu".'),
                        TextInput::make('contact_person_role')->label('Designation')
                            ->helperText('e.g. "Founder & Director".'),
                        Textarea::make('contact_address')->rows(2)->columnSpanFull(),
                        Textarea::make('map_embed')->label('Google Maps embed URL')->rows(2)->columnSpanFull(),
                    ]),
                Section::make('Social links')
                    ->columns(2)
                    ->schema([
                        TextInput::make('social_facebook')->url()->label('Facebook'),
                        TextInput::make('social_instagram')->url()->label('Instagram'),
                        TextInput::make('social_youtube')->url()->label('YouTube'),
                        TextInput::make('social_whatsapp')->url()->label('WhatsApp link'),
                    ]),
                Section::make('Homepage statistics')
                    ->columns(4)
                    ->schema([
                        TextInput::make('stat_students')->numeric()->label('Students'),
                        TextInput::make('stat_years')->numeric()->label('Years'),
                        TextInput::make('stat_centers')->numeric()->label('Training centres'),
                        TextInput::make('stat_awards')->numeric()->label('Awards'),
                    ]),
                Section::make('SEO defaults')
                    ->schema([
                        TextInput::make('meta_title'),
                        Textarea::make('meta_description')->rows(2),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($this->keys as $key) {
            Setting::query()->updateOrCreate(
                ['key' => $key],
                ['value' => $data[$key] ?? null],
            );
        }

        Notification::make()->title('Settings saved')->success()->send();
    }
}
