<?php

namespace App\Filament\Ticket\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Ticket;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\CategoryTicket;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Ticket\Resources\TicketResource\Pages;
use Filament\Infolists\Components\Card as InfolistCard;
use Parallax\FilamentComments\Tables\Actions\CommentsAction;
use Parallax\FilamentComments\Infolists\Components\CommentsEntry;
use App\Filament\Ticket\Resources\TicketResource\RelationManagers;
use App\Filament\Ticket\Resources\TicketResource\RelationManagers\FeedbackRelationManager;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationGroup = 'Ticketing';

    public static function form(Form $form): Form
    {
        $user = auth()->user();

        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('ticket_number')
                            ->disabled()
                            ->default(fn() => Ticket::generateTicketNumber())
                            ->required(),

                        Forms\Components\TextInput::make('title')
                            ->required(),
                        
                        Forms\Components\Textarea::make('description')
                            ->required(),
                    ])->columns(2),
                Card::make()
                    ->schema([       
                        FileUpload::make('file')
                            ->label('Photo')
                            ->disk('public'),                     
                    ])->columns(2),
                Card::make()
                    ->schema([
                        ToggleButtons::make('priority')
                            ->options([
                                'Low' => 'Low',
                                'Medium' => 'Medium',
                                'Urgent' => 'Urgent',
                                'Critical' => 'Critical'
                            ])
                            ->colors([
                                'Low' => 'secondary',
                                'Medium' => 'info',
                                'Urgent' => 'warning',
                                'Critical' => 'danger',
                            ])
                            ->inline()
                            ->required(),
                        
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required(),
                        
                        Forms\Components\Select::make('assigned_to')
                            ->label('Assign To')
                            ->options(function () use ($user) {
                                $query = User::query()
                                    ->select('id', 'name', 'role')
                                    ->distinct()
                                    ->when($user->isUser(), function ($query) {
                                        $query->whereNotIn('role', ['SECURITY', 'USER']);
                                    });
        
                                $users = $query->get();
        
                                return $users->mapWithKeys(function ($user) {
                                    return [$user->id => $user->name];
                                });
                            })
                            ->required(),
                    ])->columns(2),                
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistCard::make([
                    TextEntry::make('ticket_number'),
                    TextEntry::make('title'),
                    TextEntry::make('description'),
                    ImageEntry::make('file')
                        ->label('Photo'),
                    TextEntry::make('status')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'Open' => 'danger',
                            'In Progress' => 'warning',
                            'Closed' => 'success',
                        }),
                    TextEntry::make('priority')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'Low' => 'gray',
                            'Medium' => 'warning',
                            'Urgent' => 'danger',
                            'Critical' => 'danger'
                        }),
                    TextEntry::make('category.name'),
                    TextEntry::make('assignedUser.name'),
                    TextEntry::make('closed_at')
                        ->label('Closed Date'),
                ])->columns(2),
                InfolistCard::make([
                    CommentsEntry::make('filament_comments')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ticket_number')
            ->columns([
                Tables\Columns\TextColumn::make('ticket_number')
                    ->sortable()
                    ->label('Ticket Number'),
                
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->label('Title'),
                
                Tables\Columns\TextColumn::make('description')
                    ->sortable()
                    ->label('Description'),
                
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Open' => 'danger',
                        'In Progress' => 'warning',
                        'Closed' => 'success',
                    })
                    ->label('Status'),
                
                Tables\Columns\TextColumn::make('priority')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Low' => 'gray',
                        'Medium' => 'warning',
                        'Urgent' => 'danger',
                        'Critical' => 'danger'
                    })
                    ->label('Priority'),
                
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category'),
                
                Tables\Columns\TextColumn::make('assignedUser.name')
                    ->label('Assigned To'),
                
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
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->hidden(fn ($record) => $record->status === 'Closed')
                    ->label('Edit'),

                Tables\Actions\DeleteAction::make()
                    ->hidden(fn ($record) => $record->status === 'Closed')
                    ->label('Delete'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            FeedbackRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'view' => Pages\ViewTicket::route('/{record}'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
