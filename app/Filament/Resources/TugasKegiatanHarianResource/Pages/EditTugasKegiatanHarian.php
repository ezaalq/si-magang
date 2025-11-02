<?php

namespace App\Filament\Resources\TugasKegiatanHarianResource\Pages;

use App\Filament\Resources\TugasKegiatanHarianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTugasKegiatanHarian extends EditRecord
{
    protected static string $resource = TugasKegiatanHarianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
