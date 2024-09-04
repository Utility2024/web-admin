<?php

namespace App\Filament\Ticket\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class LatestTicketing extends BaseWidget
{
    protected static ?string $heading = 'Latest My Ticket';

    public function table(Table $table): Table
    {
        $userId = Auth::id(); // Get the ID of the currently authenticated user

        return $table
            ->query(
                Ticket::where('created_by', $userId)
                    ->latest() // Order by the most recent tickets
            )
            ->columns([
                Tables\Columns\TextColumn::make('ticket_number')
                    ->label('Ticket Number')
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Open' => 'danger',
                        'In Progress' => 'warning',
                        'Closed' => 'success',
                    }),

                Tables\Columns\TextColumn::make('priority')
                    ->label('Priority')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Low' => 'info',        // Warna 'info' untuk 'Low'
                        'Medium' => 'warning',  // Warna 'warning' untuk 'Medium'
                        'Urgent' => 'danger',   // Warna 'danger' untuk 'Urgent'
                        'Critical' => 'primary' // Warna 'primary' untuk 'Critical'
                    }),
  
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->url(fn (Ticket $record): string => "http://portal.siix-ems.co.id/ticket/tickets/{$record->id}")
                    ->label('View')
            ]);
    }
}
