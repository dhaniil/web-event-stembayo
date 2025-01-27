<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Tabs;
use Illuminate\Http\UploadedFile;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Spatie\Image\Image;


use Illuminate\Support\Facades\Storage;

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

    /**
     * @throws \Exception
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(1)
                    ->schema([
                        Tabs::make('Detail Event')
                            ->tabs([
                                Tabs\Tab::make('Informasi Event')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('name')
                                                    ->label('Name')
                                                    ->required()
                                                    ->columnSpan(1),

                                                DatePicker::make('start_date')
                                                    ->label('Start Date')
                                                    ->required()
                                                    ->columnSpan(1),

                                                TimePicker::make('jam_mulai')
                                                    ->label('Start Time')
                                                    ->required()
                                                    ->columnSpan(1),

                                                DatePicker::make('end_date')
                                                    ->label('End Date')
                                                    ->required()
                                                    ->columnSpan(1),

                                                TimePicker::make('jam_selesai')
                                                    ->label('End Time')
                                                    ->required()
                                                    ->columnSpan(1),

                                                Select::make('status')
                                                    ->label('Status')
                                                    ->options([
                                                        'selesai' => 'Selesai',
                                                        'sedang berlangsung' => 'Sedang Berlangsung',
                                                        'dibatalkan' => 'Dibatalkan',
                                                        'ditunda' => 'Ditunda',
                                                        'belum mulai' => 'Belum Mulai',
                                                    ])
                                                    ->required()
                                                    ->columnSpan(1),

                                                TextInput::make('tempat')
                                                    ->label('Location')
                                                    ->required()
                                                    ->columnSpan(1),

                                                TextInput::make('type')
                                                    ->label('Tipe')
                                                    ->required()
                                                    ->columnSpan(1),

                                                TextInput::make('penyelenggara')
                                                    ->label('Penyelenggara')
                                                    ->required()
                                                    ->columnSpan(2),
                                            ]),
                                    ]),

                                Tabs\Tab::make('Deskripsi dan Media')
                                    ->schema([
                                        RichEditor::make('description')
                                            ->label('Description')
                                            ->required()
                                            ->columnSpan('1'),

                                        FileUpload::make('image')
                                            ->label('Image')
                                            ->image()
                                            ->directory('events')
                                            ->preserveFilenames()
                                            ->required()
                                            ->panelLayout('integrated')
                                            ->removeUploadedFileButtonPosition('right')
                                            ->loadingIndicatorPosition('right')
                                            ->previewable(true)
                                            ->uploadButtonPosition('left')
                                            ->uploadProgressIndicatorPosition('left')
                                            ->columnSpan('full')
                                            ->imageEditor()
                                            ->uploadingMessage('Mengupload gambar...')
                                            ->imageEditorMode(2)
                                            ->progressIndicatorPosition('right'),
                                    ]),


                                Tabs\Tab::make('kategori dan Organisi')
                                    ->schema([
                                        Select::make('kategori')
                                            ->label('Kategori')
                                            ->options(static::$kategoriOptions)
                                            ->required()
                                            ->columnSpan('full'),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Name')->searchable(),
                TextColumn::make('start_date')->label('Tanggal Mulai')->searchable(),
                TextColumn::make('tempat')->label('Tempat')->searchable(),
                TextColumn::make('status')->label('Status')->sortable()->searchable(),
                TextColumn::make('kategori')->label('Kategori')->searchable()->sortable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Event Image')
                    ->url(fn ($record) => Storage::url('events/' . $record->image)),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
