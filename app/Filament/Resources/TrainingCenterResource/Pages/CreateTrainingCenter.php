<?php

namespace App\Filament\Resources\TrainingCenterResource\Pages;

use App\Filament\Resources\TrainingCenterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateTrainingCenter extends CreateRecord
{
    use Translatable;

    protected static string $resource = TrainingCenterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
