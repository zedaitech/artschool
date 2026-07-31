<?php

namespace App\Filament\Resources\TrainingCenterResource\Pages;

use App\Filament\Resources\TrainingCenterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;

class ListTrainingCenters extends ListRecords
{
    use Translatable;

    protected static string $resource = TrainingCenterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
