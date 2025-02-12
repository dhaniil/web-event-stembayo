<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityLogResource\Pages;
use App\Filament\Resources\ActivityLogResource\RelationManagers;
use App\Models\ActivityLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;

class ActivityLogResource extends Resource
{
    protected static ?string $model = ActivityLog::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Sistem';
    protected static ?string $navigationLabel = 'Log Aktivitas';
    protected static ?string $modelLabel = 'Log Aktivitas';
    protected static ?int $navigationSort = 100;

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->description(fn ($record) => $record->created_at->diffForHumans()),
                TextColumn::make('causer.name')
                    ->label('User')
                    ->description(fn($record) => $record->causer?->email ?? '-')
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Aktivitas')
                    ->formatStateUsing(function($record) {
                        $description = ucfirst($record->description);
                        $subjectType = str_replace('App\\Models\\', '', $record->subject_type);
                        return "{$description} {$subjectType}";
                    })
                    ->color(fn($record) => match ($record->description) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        default => 'gray'
                    })
                    ->icon(fn($record) => match ($record->description) {
                        'created' => 'heroicon-o-plus-circle',
                        'updated' => 'heroicon-o-pencil',
                        'deleted' => 'heroicon-o-trash',
                        default => 'heroicon-o-document'
                    })
                    ->wrap(),
                TextColumn::make('properties')
                    ->label('Detail Perubahan')
                    ->formatStateUsing(function ($state) {
                        if (is_string($state)) return $state;
                        if (!$state) return '-';
                        
                        $attributes = $state['attributes'] ?? [];
                        $old = $state['old'] ?? [];
                        
                        if (empty($attributes) && empty($old)) return '-';
                        
                        $changes = [];
                        foreach ($attributes as $key => $value) {
                            if (isset($old[$key]) && $old[$key] !== $value) {
                                $changes[] = "- $key: " . $old[$key] . " → " . $value;
                            } elseif (!isset($old[$key])) {
                                $changes[] = "- $key: " . $value;
                            }
                        }
                        
                        return implode("\n", $changes);
                    })
                    ->wrap(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('log_name')
                    ->label('Tipe Log')
                    ->options([
                        'default' => 'Default',
                        'user' => 'Pengguna',
                        'event' => 'Event',
                        'berita' => 'Berita',
                        'system' => 'Sistem',
                    ])
                    ->multiple(),
                Tables\Filters\SelectFilter::make('description')
                    ->label('Jenis Aktivitas')
                    ->options([
                        'created' => 'Dibuat',
                        'updated' => 'Diubah',
                        'deleted' => 'Dihapus',
                        'login' => 'Login',
                        'logout' => 'Logout',
                    ])
                    ->multiple(),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dari'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Sampai'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivityLogs::route('/'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereDate('created_at', today())->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'info';
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
