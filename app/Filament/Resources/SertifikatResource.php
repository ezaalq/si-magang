<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SertifikatResource\Pages;
use App\Filament\Resources\SertifikatResource\RelationManagers;
use App\Models\Sertifikat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SertifikatResource extends Resource
{
    protected static ?string $model = Sertifikat::class;
    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $navigationLabel = 'Sertifikat';
    protected static ?string $navigationGroup = 'Manajemen Magang';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name', fn ($query) => $query->where('role', 'mahasiswa'))
                ->label('Mahasiswa')
                ->required()
                ->searchable(),
            Forms\Components\TextInput::make('nomor_sertifikat')
                ->required()
                ->unique(ignoreRecord: true)
                ->default(fn () => 'CERT-' . date('Y') . '-' . strtoupper(substr(md5(time()), 0, 8))),
            Forms\Components\DatePicker::make('tanggal_terbit')->required()->default(now()),
            Forms\Components\DatePicker::make('tanggal_mulai_magang')->required(),
            Forms\Components\DatePicker::make('tanggal_selesai_magang')->required(),
            Forms\Components\FileUpload::make('file_sertifikat')
                ->disk('public')
                ->directory('sertifikat')
                ->acceptedFileTypes(['application/pdf']),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Mahasiswa')->searchable(),
                Tables\Columns\TextColumn::make('nomor_sertifikat')->searchable(),
                Tables\Columns\TextColumn::make('tanggal_terbit')->date()->sortable(),
                Tables\Columns\TextColumn::make('tanggal_mulai_magang')->date()->label('Mulai'),
                Tables\Columns\TextColumn::make('tanggal_selesai_magang')->date()->label('Selesai'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn ($record) => $record->file_sertifikat ? \Storage::url($record->file_sertifikat) : null)
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => $record->file_sertifikat),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\SertifikatResource\Pages\ListSertifikats::route('/'),
            'create' => \App\Filament\Resources\SertifikatResource\Pages\CreateSertifikat::route('/create'),
            'edit' => \App\Filament\Resources\SertifikatResource\Pages\EditSertifikat::route('/{record}/edit'),
        ];
    }
}
