<?php

namespace App\Filament\Resources\IndeksNilaiResource\Pages;

use App\Filament\Resources\IndeksNilaiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIndeksNilai extends EditRecord
{
    protected static string $resource = IndeksNilaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
