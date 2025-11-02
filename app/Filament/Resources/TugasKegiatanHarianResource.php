<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TugasKegiatanHarianResource\Pages;
use App\Models\TugasKegiatanHarian;
use App\Models\User;
use App\Models\TugasMahasiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TugasKegiatanHarianResource extends Resource
{
    protected static ?string $model = TugasKegiatanHarian::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Tugas Kegiatan';

    protected static ?string $navigationGroup = 'Manajemen Magang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Tugas')
                    ->schema([
                        Forms\Components\TextInput::make('judul_tugas')
                            ->label('Judul Tugas')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi Tugas')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\Select::make('kategori')
                            ->label('Kategori')
                            ->options([
                                'photographer' => 'Photographer',
                                'videographer' => 'Videographer',
                                'prerelease' => 'Pre-Release',
                            ])
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                // Reset mahasiswa selection when kategori changes
                                $set('mahasiswa_ids', []);
                            }),
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'active' => 'Active',
                                'completed' => 'Completed',
                            ])
                            ->default('active')
                            ->required(),
                        Forms\Components\DatePicker::make('tanggal_mulai')
                            ->label('Tanggal Mulai')
                            ->required(),
                        Forms\Components\DatePicker::make('tanggal_selesai')
                            ->label('Tanggal Selesai')
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Assign Mahasiswa')
                    ->schema([
                        Forms\Components\CheckboxList::make('mahasiswa_ids')
                            ->label('Pilih Mahasiswa')
                            ->options(function (Forms\Get $get) {
                                $kategori = $get('kategori');
                                if (!$kategori) {
                                    return [];
                                }
                                return User::where('role', 'mahasiswa')
                                    ->where('kategori', $kategori)
                                    ->pluck('name', 'id');
                            })
                            ->columns(2)
                            ->columnSpanFull()
                            ->helperText('Pilih mahasiswa yang akan ditugaskan'),
                    ])
                    ->hidden(fn (string $context): bool => $context === 'edit'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul_tugas')
                    ->label('Judul Tugas')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('kategori')
                    ->label('Kategori')
                    ->colors([
                        'primary' => 'photographer',
                        'success' => 'videographer',
                        'warning' => 'prerelease',
                    ]),
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->label('Mulai')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->label('Selesai')
                    ->date()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'active',
                        'secondary' => 'completed',
                    ]),
                Tables\Columns\TextColumn::make('tugasMahasiswa_count')
                    ->label('Jumlah Mahasiswa')
                    ->counts('tugasMahasiswa')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->options([
                        'photographer' => 'Photographer',
                        'videographer' => 'Videographer',
                        'prerelease' => 'Pre-Release',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'active' => 'Active',
                        'completed' => 'Completed',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTugasKegiatanHarians::route('/'),
            'create' => Pages\CreateTugasKegiatanHarian::route('/create'),
            'edit' => Pages\EditTugasKegiatanHarian::route('/{record}/edit'),
            'view' => Pages\ViewTugasKegiatanHarian::route('/{record}'),
        ];
    }

    // Hook after create to assign mahasiswa
    public static function afterCreate(TugasKegiatanHarian $record, array $data): void
    {
        if (isset($data['mahasiswa_ids']) && is_array($data['mahasiswa_ids'])) {
            foreach ($data['mahasiswa_ids'] as $userId) {
                TugasMahasiswa::create([
                    'tugas_id' => $record->id,
                    'user_id' => $userId,
                    'status_pengerjaan' => 'belum',
                ]);
            }
        }
    }
}
