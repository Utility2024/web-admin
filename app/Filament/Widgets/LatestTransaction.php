<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Transaction;

class LatestTransaction extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';
    
    protected static ?string $heading = 'Latest Transactions Materials';

    protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Transaction::query()->latest('id')->limit(5); // Limit the results to the 5 most recent transactions
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery()) // Use the query that limits results to 5
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date(),
                Tables\Columns\TextColumn::make('material.sap_code')
                    ->label('SAP Code'),
                Tables\Columns\TextColumn::make('material.description')
                    ->label('Description'),
                Tables\Columns\TextColumn::make('transaction_type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'IN' => 'info',
                        'OUT' => 'danger',
                        default => 'secondary',
                    })
                    ->icons([
                        'IN' => 'heroicon-o-arrow-left-end-on-rectangle',
                        'OUT' => 'heroicon-o-arrow-right-start-on-rectangle',
                    ]),
                Tables\Columns\TextColumn::make('qty')
                    ->label('Quantity')
                    ->numeric(),
                Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->badge(),
                Tables\Columns\TextColumn::make('total_price')
                    ->money('IDR')
                    ->badge(), 
                Tables\Columns\TextColumn::make('pic')
                    ->label('PIC'),
                Tables\Columns\TextColumn::make('keterangan')
                    ->label('Keterangan'),
                ]);
    }
}
