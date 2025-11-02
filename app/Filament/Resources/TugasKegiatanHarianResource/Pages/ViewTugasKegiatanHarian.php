<?php

namespace App\Filament\Resources\TugasKegiatanHarianResource\Pages;

use App\Filament\Resources\TugasKegiatanHarianResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;

class ViewTugasKegiatanHarian extends ViewRecord
{
    protected static string $resource = TugasKegiatanHarianResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make('Informasi Tugas')
                    ->schema([
                        Components\TextEntry::make('judul_tugas')->label('Judul'),
                        Components\TextEntry::make('kategori')->badge(),
                        Components\TextEntry::make('status')->badge(),
                        Components\TextEntry::make('tanggal_mulai')->date(),
                        Components\TextEntry::make('tanggal_selesai')->date(),
                        Components\TextEntry::make('deskripsi')->columnSpanFull(),
                    ])->columns(2),

                Components\Section::make('Mahasiswa yang Ditugaskan')
                    ->schema([
                        Components\RepeatableEntry::make('tugasMahasiswa')
                            ->label('')
                            ->schema([
                                Components\TextEntry::make('user.name')->label('Nama Mahasiswa'),
                                Components\TextEntry::make('user.nim')->label('NIM'),
                                Components\TextEntry::make('status_pengerjaan')
                                    ->label('Status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'belum' => 'gray',
                                        'proses' => 'warning',
                                        'selesai' => 'success',
                                    }),
                                Components\TextEntry::make('tanggal_submit')
                                    ->label('Tanggal Submit')
                                    ->dateTime()
                                    ->placeholder('Belum submit'),
                                Components\TextEntry::make('nilai')
                                    ->label('Nilai')
                                    ->placeholder('Belum dinilai'),
                            ])->columns(4),
                    ]),
            ]);
    }
}
