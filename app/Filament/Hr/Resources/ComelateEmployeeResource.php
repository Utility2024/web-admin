<?php

namespace App\Filament\Hr\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use App\Models\ComelateEmployee;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Hr\Resources\ComelateEmployeeResource\Pages;
use App\Filament\Hr\Resources\ComelateEmployeeResource\RelationManagers;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Card as InfolistCard;
use Filament\Forms\Components\Card;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;

class ComelateEmployeeResource extends Resource
{
    protected static ?string $model = ComelateEmployee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('nik')
                            ->label('NIK')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->required(),
                        Forms\Components\TextInput::make('department')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('alasan_terlambat')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nama_security')
                            ->required()
                            ->maxLength(255),
                        DatePicker::make('tanggal'),
                        TimePicker::make('jam')
                    ])->columns(2)
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistCard::make([
                    TextEntry::make('nik'),
                    TextEntry::make('name'),
                    TextEntry::make('department'),
                    TextEntry::make('alasan_terlambat'),
                    TextEntry::make('nama_security'),
                    TextEntry::make('tanggal'),
                    TextEntry::make('jam'),
                    // TextEntry::make('created_at'),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('row_number')
                //     ->label('No.')
                //     ->getStateUsing(fn ($rowLoop) => $rowLoop->iteration),
                Tables\Columns\TextColumn::make('id')
                    ->label("No.")
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nik')
                    ->sortable()
                    ->label('NIK'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('department')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alasan_terlambat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_security')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jam')
                    ->label('Jam')
                    ->searchable(),
                Tables\Columns\TextColumn::make('creator.name')
                    ->label('Created By')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updater.name')
                    ->label('Updated By')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label("Date Time")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                    ExportBulkAction::make()
                        ->label('Export Excel'),
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListComelateEmployees::route('/'),
            'create' => Pages\CreateComelateEmployee::route('/create'),
            'view' => Pages\ViewComelateEmployee::route('/{record}'),
            'edit' => Pages\EditComelateEmployee::route('/{record}/edit'),
        ];
    }
}
