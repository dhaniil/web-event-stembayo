<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventBannerResource\Pages;
use App\Filament\Resources\EventBannerResource\RelationManagers;
use App\Models\EventBanner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventBannerResource extends Resource
{
    protected static ?string $model = EventBanner::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Content';
    protected static ?string $modelLabel = 'Banner Event';
    protected static ?string $pluralModelLabel = 'Banner Event';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->label('Banner Image')
                    ->image()
                    ->imageEditor()
                    ->imageEditorMode(2)
                    ->helperText('Recommended resolution: 1920x1080px (16:9)')
                    ->required()
                    ->maxSize(5120)
                    ->directory('event-banners')
                    ->columnSpanFull(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->contentGrid([
                'md' => 2,
                'lg' => 3,
            ])
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Banner')
                    ->height(200)
                    ->extraImgAttributes(['class' => 'object-cover w-full rounded-lg shadow-md'])
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton(),
                Tables\Actions\DeleteAction::make()
                    ->iconButton(),
            ])
            ->bulkActions([]);
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
            'index' => Pages\ListEventBanners::route('/'),
            'create' => Pages\CreateEventBanner::route('/create'),
            'edit' => Pages\EditEventBanner::route('/{record}/edit'),
        ];
    }
}
