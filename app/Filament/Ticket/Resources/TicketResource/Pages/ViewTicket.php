<?php

namespace App\Filament\Ticket\Resources\TicketResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
// use EightyNine\Approvals\Models\ApprovableModel;
use App\Filament\Ticket\Resources\TicketResource;
use Parallax\FilamentComments\Actions\CommentsAction;

class ViewTicket extends ViewRecord
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->hidden(fn ($record) => in_array($record->status, ['In Progress', 'Closed'])),
        ];
    }
}
