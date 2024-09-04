<?php

namespace App\Filament\Ticket\Resources\TicketResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Card;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use Filament\Resources\RelationManagers\RelationManager;

class FeedbackRelationManager extends RelationManager
{
    protected static string $relationship = 'feedback';

    public function form(Form $form): Form
    {
        $ticketId = session('ticket_id');

        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\Select::make('ticket_id')
                            ->relationship('ticket', 'ticket_number')
                            ->required()
                            ->searchable()
                            ->label('Ticket')
                            ->reactive()
                            ->default($ticketId)
                            ->extraAttributes(['style' => 'pointer-events: none;'])
                            ->afterStateUpdated(function (callable $set, $state) {
                                $ticket = \App\Models\Ticket::find($state);
                                if ($ticket) {
                                    $set('status', $ticket->status);
                                }
                            }),
                        
                        Forms\Components\ToggleButtons::make('status')
                            ->options([
                                'Open' => 'Open',
                                'In Progress' => 'In Progress',
                                'Closed' => 'Closed',
                            ])
                            ->colors([
                                'Open' => 'info',
                                'In Progress' => 'warning',
                                'Closed' => 'success',
                            ])
                            ->inline()
                            ->default('Open')
                            ->required()
                            ->label('Status')
                            ->reactive()
                            ->afterStateUpdated(function ($state) {
                                $ticket = \App\Models\Ticket::find(session('ticket_id'));
                                if ($ticket) {
                                    $ticket->status = $state;
                                    $ticket->save();
                                }
                            }),
                        
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required()
                            ->searchable()
                            ->label('Name')
                            ->default(Auth::id())
                            ->extraAttributes(['style' => 'pointer-events: none;']),
                        
                        Forms\Components\Textarea::make('comments')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull(),
                            
                        Forms\Components\FileUpload::make('photo')
                            ->disk('public')
                            ->label('Photo')
                            ->image()
                    ])
                ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('comments')
            ->columns([
                Tables\Columns\TextColumn::make('comments')
                    ->label('Comments'),

                Tables\Columns\TextColumn::make('user.name'),
                
                Tables\Columns\TextColumn::make('status')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Open' => 'danger',
                        'In Progress' => 'warning',
                        'Closed' => 'success',
                    })
                    ->label('Status'),
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Photo')
                    ->disk('public'),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Created At'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Updated At'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
