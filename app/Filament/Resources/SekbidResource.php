<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SekbidResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\UserRole;

class SekbidResource extends Resource
{
    public static function shouldRegisterNavigation(): bool
    {
        $user = auth()->user();
        return in_array($user->role, [
            UserRole::SuperAdmin->value,
            UserRole::Admin->value,
        ]);
    }
    protected static ?string $model = User::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Sekbid';
    protected static ?string $modelLabel = 'Sekbid';
    protected static ?string $navigationGroup = 'Manajemen User';
    protected static ?string $pluralModelLabel = 'Sekbid';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->minLength(8),
                Forms\Components\TextInput::make('nomer')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\Select::make('kelas')
                    ->options([
                        '10' => '10',
                        '11' => '11',
                        '12' => '12',
                        '13' => '13',
                    ]),
                Forms\Components\Select::make('jurusan')
                    ->options([
                        'SIJA A' => 'SIJA A',
                        'SIJA B' => 'SIJA B',
                        'TFLM A' => 'TFLM A',
                        'TFLM B' => 'TFLM B',
                        'KA A' => 'KA A',
                        'KA B' => 'KA B',
                        'GP A' => 'GP A',
                        'GP B' => 'GP B',
                        'DPIB A' => 'DPIB A',
                        'DPIB B' => 'DPIB B',
                        'TKR A' => 'TKR A',
                        'TKR B' => 'TKR B',
                        'TOI A' => 'TOI A',
                        'TOI B' => 'TOI B',
                        'TEK A' => 'TEK A',
                        'TEK B' => 'TEK B',
                        'TKI A' => 'TKI A',
                        'TKI B' => 'TKI B',
                        'TP' => 'TP',
                        'TBKR' => 'TBKR',
                        'TITL' => 'TITL',
                    ]),
                Forms\Components\FileUpload::make('profile_picture')
                    ->image()
                    ->directory('profile-pictures'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('profile_picture'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nomer'),
                Tables\Columns\TextColumn::make('kelas'),
                Tables\Columns\TextColumn::make('jurusan'),
            ])
            ->filters([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSekbids::route('/'),
            'create' => Pages\CreateSekbid::route('/create'),
            'edit' => Pages\EditSekbid::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('role', 'sekbid');
    }
}