<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Enums\ThemeMode;


class EventResource extends Resource
{
    protected static ?string $model = Event::class;
    protected static ?string $navigationGroup = 'Manajemen Event';

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static array $kategoriOptions = [
        'KTYME Islam' => 'KTYME Islam',
        'KTYME Kristiani' => 'KTYME Kristiani',
        'KBBP' => 'KBBP',
        'KBPL' => 'KBPL',
        'BPPK' => 'BPPK',
        'KK' => 'KK',
        'PAKS' => 'PAKS',
        'KJDK' => 'KJDK',
        'PPBN' => 'PPBN', 
        'HUMTIK' => 'HUMTIK',
        '-' => '-'
    ];

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label('Name')->required(),
                Forms\Components\FileUpload::make('image')
                    ->label('Image')
                    ->image()
                    ->directory('events')
                    ->required(),
                Forms\Components\RichEditor::make('description')->label('Description')->required(),
                Forms\Components\DatePicker::make('start_date')->label('Start Date')->required(),
                Forms\Components\TimePicker::make('jam_mulai')->label('Start Time')->required(),
                Forms\Components\DatePicker::make('end_date')->label('End Date')->required(),
                Forms\Components\TimePicker::make('jam_selesai')->label('End Time')->required(),
                Forms\Components\TextInput::make('tempat')->label('Location')->required(),
                Forms\Components\Select::make('kategori')
                    ->label('Kategori')
                    ->options(self::$kategoriOptions)
                    ->required(),
                Forms\Components\TextInput::make('type')
                    ->label('Tipe')
                    ->required(),
                Forms\Components\TextInput::make('penyelenggara')
                    ->label('Penyelenggara')
                    ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('name')->label('Name')->searchable(),
                TextColumn::make('description')
                    ->label('Description')
                    ->searchable()
                    ->limit(100),   
                TextColumn::make('date')->label('Date')->searchable(),
                TextColumn::make('kategori')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
