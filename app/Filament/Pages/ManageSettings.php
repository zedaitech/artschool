<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
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
        'social_facebook', 'social_instagram', 'social_youtube', 'social_whatsapp', 'blog_url',
        'meta_title', 'meta_description', 'og_image',
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
                        Textarea::make('contact_address')->rows(6)->columnSpanFull()
                            ->helperText('Line breaks are preserved on the site.'),
                        Textarea::make('map_embed')->label('Google Maps embed URL')->rows(2)->columnSpanFull(),
                    ]),
                Section::make('Social links')
                    ->columns(2)
                    ->schema([
                        TextInput::make('social_facebook')->url()->label('Facebook'),
                        TextInput::make('social_instagram')->url()->label('Instagram'),
                        TextInput::make('social_youtube')->url()->label('YouTube'),
                        TextInput::make('social_whatsapp')->url()->label('WhatsApp link'),
                        TextInput::make('blog_url')->url()->label('Blog')
                            ->helperText('Linked from the main menu and footer. Leave empty to hide the link.')
                            ->columnSpanFull(),
                    ]),
                Section::make('Homepage statistics')
                    ->columns(4)
                    ->schema([
                        TextInput::make('stat_students')->numeric()->label('Students'),
                        TextInput::make('stat_years')->numeric()->label('Years'),
                        TextInput::make('stat_centers')->numeric()->label('Training centres'),
                        TextInput::make('stat_awards')->numeric()->label('Awards'),
                    ]),
                Section::make('SEO & sharing')
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Homepage title')
                            ->helperText('Shown in Google results and the browser tab. Around 60 characters.'),
                        Textarea::make('meta_description')
                            ->rows(2)
                            ->label('Homepage description')
                            ->helperText('The grey text under the title in search results. Around 155 characters.'),
                        FileUpload::make('og_image')
                            ->label('Share image')
                            ->image()
                            ->directory('seo')
                            ->imageEditor()
                            ->helperText('Shown when the site is shared on WhatsApp, Facebook or X. Landscape, ideally 1200 x 630.'),
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
