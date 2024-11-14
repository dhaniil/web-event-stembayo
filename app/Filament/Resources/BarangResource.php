<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangResource\Pages;
use App\Models\Barang;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
// use Filament\Resources\Form;
use Filament\Resources\Resource;
// use Filament\Resources\Table;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('merk')->required(),
                Select::make('kategori_id')
                    ->relationship('kategori', 'kategori')
                    ->required(),
                TextInput::make('seri')->required(),
                TextInput::make('spesifikasi')->required(),
                TextInput::make('stok')->numeric()->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('merk')->sortable()->searchable(),
                TextColumn::make('kategori.kategori')->label('Kategori')->searchable(),
                TextColumn::make('seri')->sortable()->searchable(),
                TextColumn::make('spesifikasi')->sortable()->searchable(),
                TextColumn::make('stok')->sortable()->searchable(),
            ])
            ->actions([
                Action::make('tambahStok')
                    ->label('Tambah Stok')
                    ->form([
                        DatePicker::make('tanggal')->required(),
                        TextInput::make('jumlah')->required()->numeric(),
                    ])
                    ->action(function ($record, $data) {
                        $record->tambahStok($data['jumlah'], $data['tanggal']);
                    }),
                Action::make('kurangiStok')
                    ->label('Kurangi Stok')
                    ->form([
                        TextInput::make('jumlah')->required()->numeric(),
                        DatePicker::make('tanggal')->required(),
                    ])
                    ->action(function ($record, $data) {
                        $record->kurangiStok($data['jumlah'], $data['tanggal']);
                    }),
            ]);
    }

    protected static ?string $navigationLabel = 'Barang';
    protected static ?string $slug = 'barang';
    public static function getPluralModelLabel(): string
    {
        return 'Barang'; // Atur label jamak yang benar
    }
    
    public static function getModelLabel(): string
    {
        return 'Barang'; // Atur label tunggal yang benar
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBarang::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}
