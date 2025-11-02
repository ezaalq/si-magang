<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaporanAkhirResource\Pages;
use App\Filament\Resources\LaporanAkhirResource\RelationManagers;
use App\Models\LaporanAkhir;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

namespace App\Filament\Resources;

use App\Models\LaporanAkhir;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LaporanAkhirResource extends Resource
{
    protected static ?string $model = LaporanAkhir::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Laporan Akhir';
    protected static ?string $navigationGroup = 'Manajemen Magang';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name', fn ($query) => $query->where('role', 'mahasiswa'))
                ->label('Mahasiswa')
                ->required()
                ->searchable(),
            Forms\Components\TextInput::make('judul')->required(),
            Forms\Components\Textarea::make('ringkasan')->rows(3),
            Forms\Components\FileUpload::make('file_laporan')
                ->disk('public')
                ->directory('laporan')
                ->acceptedFileTypes(['application/pdf'])
                ->required(),
            Forms\Components\DatePicker::make('tanggal_submit')->required(),
            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'revisi' => 'Revisi',
                    'approved' => 'Approved',
                ])
                ->default('pending')
                ->required(),
            Forms\Components\Textarea::make('catatan_revisi')
                ->label('Catatan Revisi')
                ->rows(3)
                ->visible(fn ($get) => $get('status') === 'revisi'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Mahasiswa')->searchable(),
                Tables\Columns\TextColumn::make('judul')->searchable(),
                Tables\Columns\TextColumn::make('tanggal_submit')->date()->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'danger' => 'revisi',
                        'success' => 'approved',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'revisi' => 'Revisi',
                        'approved' => 'Approved',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn ($record) => \Storage::url($record->file_laporan))
                    ->openUrlInNewTab(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\LaporanAkhirResource\Pages\ListLaporanAkhirs::route('/'),
            'create' => \App\Filament\Resources\LaporanAkhirResource\Pages\CreateLaporanAkhir::route('/create'),
            'edit' => \App\Filament\Resources\LaporanAkhirResource\Pages\EditLaporanAkhir::route('/{record}/edit'),
        ];
    }
}
