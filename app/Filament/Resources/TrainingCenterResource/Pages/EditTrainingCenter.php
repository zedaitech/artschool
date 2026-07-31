<?php

namespace App\Filament\Resources\TrainingCenterResource\Pages;

use App\Filament\Resources\TrainingCenterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;

class EditTrainingCenter extends EditRecord
{
    use Translatable;

    protected static string $resource = TrainingCenterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
