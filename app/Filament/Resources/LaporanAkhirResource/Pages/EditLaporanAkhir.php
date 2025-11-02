<?php

namespace App\Filament\Resources\LaporanAkhirResource\Pages;

use App\Filament\Resources\LaporanAkhirResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaporanAkhir extends EditRecord
{
    protected static string $resource = LaporanAkhirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
