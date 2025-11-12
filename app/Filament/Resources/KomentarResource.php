<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Komentar;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KomentarResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KomentarResource\RelationManagers;

class KomentarResource extends Resource
{
    protected static ?string $model = Komentar::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left';

    protected static ?string $navigationLabel = 'Komentar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detail Komentar')
                    ->schema([
                        Select::make('news_id')
                            ->label('Judul Berita')
                            ->relationship('news', 'judul')
                            ->preload()
                            ->required(),
                        TextInput::make('nama')
                            ->label('Nama Komentator')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('isi')
                            ->label('Isi Komentar')
                            ->required()
                            ->minLength(5)
                            ->maxLength(1000),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('news.judul')
                    ->label('Judul Berita')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nama')
                    ->label('Nama Komentator')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('isi')
                    ->label('Isi Komentar')
                    ->limit(50)
                    ->searchable()
                    ->sortable(),
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
            ])
            ->defaultSort('id', 'desc');
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
            'index' => Pages\ListKomentars::route('/'),
            'create' => Pages\CreateKomentar::route('/create'),
            'edit' => Pages\EditKomentar::route('/{record}/edit'),
        ];
    }
}
