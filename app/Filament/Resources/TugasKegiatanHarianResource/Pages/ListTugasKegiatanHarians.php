<?php

namespace App\Filament\Resources\TugasKegiatanHarianResource\Pages;

use App\Filament\Resources\TugasKegiatanHarianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTugasKegiatanHarians extends ListRecords
{
    protected static string $resource = TugasKegiatanHarianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
