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
        $roleOptions = [];
        if ($user && $user->isSuperadmin()) {
            // Super Admin can assign any role except Super Admin (use SuperAdminResource for that)
            $roleOptions = Role::where('name', '!=', 'Super Admin')
                ->pluck('name', 'id')
                ->toArray();
        } elseif ($user && $user->isAdmin()) {
            $roleOptions = Role::whereIn('name', ['Sekbid', 'Pengunjung'])
                ->pluck('name', 'id')
                ->toArray();
        } else {
            $roleOptions = [$pengunjungRole->id => $pengunjungRole->name];
        }

        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->unique(ignorable: fn ($record) => $record),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required(fn ($component, $get, $record) => ! $record)
                    ->minLength(8)
                    ->same('password_confirmation')
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null),
                TextInput::make('password_confirmation')
                    ->label('Confirm Password')
                    ->password()
                    ->required(fn ($component, $get, $record) => ! $record)
                    ->minLength(8),
                Select::make('roles')
                    ->label('Roles')
                    ->multiple()
                    ->options($roleOptions)
                    ->default([$pengunjungRole->id ?? null])
                    ->required(),
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
                Tables\Actions\EditAction::make()
                    ->after(function (User $record, array $data) {
                        if (isset($data['roles'])) {
                            $record->syncRoles($data['roles']);
                        }
                    })
                    ->visible(fn (User $record): bool => !$record->hasRole('Super Admin')),

                Tables\Actions\DeleteAction::make()
                    ->visible(fn (User $record): bool => !$record->hasRole('Super Admin')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->action(function ($records) {
                            $records->each(function ($record) {
                                if (!$record->hasRole('Super Admin')) {
                                    $record->delete();
                                }
                            });
                        }),
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
