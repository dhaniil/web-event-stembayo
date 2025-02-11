<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeritaResource\Pages;
use App\Models\Berita;
use App\Models\BeritaGallery;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Select;
use App\Models\Event;


class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?int $navigationSort = 2;
    protected static ?string $modelLabel = 'Berita';
    protected static ?string $pluralModelLabel = 'Berita';
    
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('judul')
                    ->label('Judul Berita')
                    ->required()
                    ->maxLength(255),

                RichEditor::make('isi')
                    ->label('Isi Berita')
                    ->required(),

                Repeater::make('galleries')
                    ->label('Gallery Event')
                    ->relationship('galleries') 
                    ->schema([
                        FileUpload::make('image_path')
                            ->label('Upload Gambar')
                            ->image()
                            ->directory('berita-gallery')   
                            ->required(),
                    ])
                    ->collapsible()
                    ->columns(2),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')->sortable()->searchable(),

            
                ImageColumn::make('galleries.image_path')->label('Gallery')->limit(3),
                TextColumn::make('event.name')->label('Event Terkait'),
            ])
            ->filters([
                // Hanya menampilkan berita dari event yang sudah selesai
                Tables\Filters\Filter::make('Hanya Event Selesai')
                    ->query(fn (Builder $query) => $query->whereHas('event', function ($query) {
                        $query->where('status', 'selesai');
                    })),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}
