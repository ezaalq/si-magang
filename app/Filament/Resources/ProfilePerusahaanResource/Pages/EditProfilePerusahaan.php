<?php

namespace App\Filament\Resources\ProfilePerusahaanResource\Pages;

use App\Filament\Resources\ProfilePerusahaanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfilePerusahaan extends EditRecord
{
    protected static string $resource = ProfilePerusahaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
