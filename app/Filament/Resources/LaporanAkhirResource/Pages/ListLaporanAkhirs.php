<?php

namespace App\Filament\Resources\LaporanAkhirResource\Pages;

use App\Filament\Resources\LaporanAkhirResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLaporanAkhirs extends ListRecords
{
    protected static string $resource = LaporanAkhirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
