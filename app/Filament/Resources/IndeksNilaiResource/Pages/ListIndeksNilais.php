<?php

namespace App\Filament\Resources\IndeksNilaiResource\Pages;

use App\Filament\Resources\IndeksNilaiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIndeksNilais extends ListRecords
{
    protected static string $resource = IndeksNilaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
