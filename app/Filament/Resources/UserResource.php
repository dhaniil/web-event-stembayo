<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Users';
    protected static ?string $navigationGroup = 'Manajemen User';
    protected static ?int $navigationSort = 1;

    public static function getModel(): string
    {
        return User::class;
    }

    public static function form(Form $form): Form
    {
        /** @var User $user */
        $user = Auth::user();
        $pengunjungRole = Role::where('name', 'Pengunjung')->first();

        // Get available roles based on current user's role
        $roleOptions = Role::when($user?->isSuperadmin(), function ($query) {
            return $query->where('name', '!=', 'Super Admin');
        })
        ->when($user?->isAdmin(), function ($query) {
            return $query->whereIn('name', ['Sekbid', 'Pengunjung']);
        })
        ->pluck('name', 'id')
        ->toArray();

        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->minLength(8)
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn ($context) => $context === 'create'),
                Select::make('roles')
                    ->label('Roles')
                    ->relationship('roles', 'name')
                    ->options($roleOptions)
                    ->default([$pengunjungRole?->id]),
                Select::make('kelas')
                    ->label('Kelas')
                    ->options([
                        '10' => '10',
                        '11' => '11',
                        '12' => '12',
                        '13' => '13',
                    ]),
                Select::make('jurusan')
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
            ]);
    }

    public static function table(Table $table): Table
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();

        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('roles.name')
                    ->label('Roles')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kelas')
                    ->label('Kelas')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jurusan')
                    ->label('Jurusan')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->multiple()
                    ->options(Role::whereNotIn('name', ['Super Admin'])->pluck('name', 'name')),
            ])
            ->actions([
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user) {
            return false;
        }
        return $user->hasAnyRole(['Super Admin', 'Admin']);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        
        /** @var User $user */
        $user = Auth::user();
        
        // Exclude Super Admin users from this resource always
        $query->whereDoesntHave('roles', function ($q) {
            $q->where('name', 'Super Admin');
        });

        // Admin can only see Sekbid and Pengunjung users
        if ($user && $user->hasRole('Admin')) {
            $query->whereHas('roles', function ($q) {
                $q->whereIn('name', ['Sekbid', 'Pengunjung', 'Admin']);
            });
        }
        
        return $query;
    }
}
