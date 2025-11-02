<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IndeksNilaiResource\Pages;
use App\Filament\Resources\IndeksNilaiResource\RelationManagers;
use App\Models\IndeksNilai;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

namespace App\Filament\Resources;

use App\Models\IndeksNilai;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class IndeksNilaiResource extends Resource
{
    protected static ?string $model = IndeksNilai::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Indeks Nilai';
    protected static ?string $navigationGroup = 'Manajemen Magang';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name', fn ($query) => $query->where('role', 'mahasiswa'))
                ->label('Mahasiswa')
                ->required()
                ->searchable(),
            Forms\Components\Section::make('Komponen Nilai')
                ->schema([
                    Forms\Components\TextInput::make('nilai_absensi')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100)
                        ->default(0)
                        ->required()
                        ->live()
                        ->afterStateUpdated(fn ($state, Forms\Set $set, Forms\Get $get) =>
                            self::hitungNilaiAkhir($set, $get)),
                    Forms\Components\TextInput::make('nilai_tugas')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100)
                        ->default(0)
                        ->required()
                        ->live()
                        ->afterStateUpdated(fn ($state, Forms\Set $set, Forms\Get $get) =>
                            self::hitungNilaiAkhir($set, $get)),
                    Forms\Components\TextInput::make('nilai_laporan')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100)
                        ->default(0)
                        ->required()
                        ->live()
                        ->afterStateUpdated(fn ($state, Forms\Set $set, Forms\Get $get) =>
                            self::hitungNilaiAkhir($set, $get)),
                    Forms\Components\TextInput::make('nilai_sikap')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100)
                        ->default(0)
                        ->required()
                        ->live()
                        ->afterStateUpdated(fn ($state, Forms\Set $set, Forms\Get $get) =>
                            self::hitungNilaiAkhir($set, $get)),
                ])->columns(2),
            Forms\Components\Section::make('Hasil')
                ->schema([
                    Forms\Components\TextInput::make('nilai_akhir')
                        ->numeric()
                        ->disabled()
                        ->dehydrated(),
                    Forms\Components\TextInput::make('grade')
                        ->disabled()
                        ->dehydrated(),
                ])->columns(2),
            Forms\Components\Textarea::make('catatan')->rows(3),
        ]);
    }

    protected static function hitungNilaiAkhir(Forms\Set $set, Forms\Get $get): void
    {
        $nilaiAkhir = (
            ($get('nilai_absensi') * 0.2) +
            ($get('nilai_tugas') * 0.4) +
            ($get('nilai_laporan') * 0.3) +
            ($get('nilai_sikap') * 0.1)
        );

        $grade = match(true) {
            $nilaiAkhir >= 85 => 'A',
            $nilaiAkhir >= 70 => 'B',
            $nilaiAkhir >= 60 => 'C',
            $nilaiAkhir >= 50 => 'D',
            default => 'E',
        };

        $set('nilai_akhir', round($nilaiAkhir, 2));
        $set('grade', $grade);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Mahasiswa')->searchable(),
                Tables\Columns\TextColumn::make('nilai_absensi')->label('Absensi'),
                Tables\Columns\TextColumn::make('nilai_tugas')->label('Tugas'),
                Tables\Columns\TextColumn::make('nilai_laporan')->label('Laporan'),
                Tables\Columns\TextColumn::make('nilai_sikap')->label('Sikap'),
                Tables\Columns\TextColumn::make('nilai_akhir')->label('Nilai Akhir')->sortable(),
                Tables\Columns\BadgeColumn::make('grade')
                    ->colors([
                        'success' => 'A',
                        'info' => 'B',
                        'warning' => 'C',
                        'danger' => fn ($state) => in_array($state, ['D', 'E']),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\IndeksNilaiResource\Pages\ListIndeksNilais::route('/'),
            'create' => \App\Filament\Resources\IndeksNilaiResource\Pages\CreateIndeksNilai::route('/create'),
            'edit' => \App\Filament\Resources\IndeksNilaiResource\Pages\EditIndeksNilai::route('/{record}/edit'),
        ];
    }
}
