<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuperAdminResource\Pages;
use App\Filament\Resources\SuperAdminResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;
use Filament\Forms\Components\TextInput;
use App\Policies\SuperAdminPolicy;
use Illuminate\Support\Facades\Auth;

class SuperAdminResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $modelLabel = 'Super Admin';
    protected static ?string $modelLabelPlural = 'Super Admin';
    
    protected static ?string $navigationLabel = 'Super Admin';
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationGroup = 'Manajemen User';
    protected static ?int $navigationSort = 0;

    public static function getPolicy(): string
    {
        return SuperAdminPolicy::class;
    }

    public static function shouldRegisterNavigation(): bool
    {
        /** @var User|null $user */
        $user = Auth::user();
        return $user && $user->hasRole('Super Admin');
    }

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
                    ->minLength(8)
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn ($context) => $context === 'create'),
                Forms\Components\Select::make('roles')
                    ->label('Role')
                    ->relationship('roles', 'name')
                    ->options(Role::where('name', 'Super Admin')->pluck('name', 'id'))
                    ->default(function () {
                        return Role::where('name', 'Super Admin')->first()?->id;
                    })
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->state(function ($record) {
                        $protectedEmails = config('filament.protected_emails', []);
                        return in_array($record->email, array_filter($protectedEmails)) 
                            ? 'Pembuat website' 
                            : $record->email;
                    }),
            ])
            ->filters([
                //
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
            'index' => Pages\ListSuperAdmins::route('/'),
            'create' => Pages\CreateSuperAdmin::route('/create'),
            'edit' => Pages\EditSuperAdmin::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Super Admin');
            })
            ->where(function ($query) {
                $protectedEmails = config('filament.protected_emails', []);
                $query->whereNotIn('email', $protectedEmails);
            });
    }
}
