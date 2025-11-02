<?php

namespace App\Filament\Resources\TugasKegiatanHarianResource\Pages;

use App\Filament\Resources\TugasKegiatanHarianResource;
use App\Models\TugasMahasiswa;
use Filament\Resources\Pages\CreateRecord;

class CreateTugasKegiatanHarian extends CreateRecord
{
    protected static string $resource = TugasKegiatanHarianResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Store mahasiswa_ids temporarily
        if (isset($data['mahasiswa_ids'])) {
            $this->mahasiswaIds = $data['mahasiswa_ids'];
            unset($data['mahasiswa_ids']);
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        // Assign tugas to selected mahasiswa
        if (isset($this->mahasiswaIds) && is_array($this->mahasiswaIds)) {
            foreach ($this->mahasiswaIds as $userId) {
                TugasMahasiswa::create([
                    'tugas_id' => $this->record->id,
                    'user_id' => $userId,
                    'status_pengerjaan' => 'belum',
                ]);
            }
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
