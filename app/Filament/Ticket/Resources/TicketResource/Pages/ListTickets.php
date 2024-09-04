<?php

namespace App\Filament\Ticket\Resources\TicketResource\Pages;

use App\Filament\Ticket\Resources\TicketResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $userId = Auth::id(); // Get the ID of the currently authenticated user
        $isSuperAdmin = Auth::user()->isSuperAdmin(); // Check if the user has the isSuperAdmin role

        $tabs = [];

        // Add 'All' tab if the user is a SUPERADMIN
        if ($isSuperAdmin) {
            $tabs['All'] = Tab::make()
                ->badge($this->getCount()) // Add badge with the total count
                // ->label("All ({$this->getCount()})"),
                ->modifyQueryUsing(fn (Builder $query) => $query);
        }

        $tabs['My Ticket'] = Tab::make()
        ->badge($this->getCountMyTickets())
        // ->label("My Ticket ({$this->getCountMyTickets()})")
        ->modifyQueryUsing(fn (Builder $query) => $query->where('created_by', $userId));

        // Add 'Assigned To Me' tab
        $tabs['Assigned To Me'] = Tab::make()
            ->badge($this->getCountAssignedToMe())
            // ->label("Assigned To Me ({$this->getCountAssignedToMe()})")
            ->modifyQueryUsing(fn (Builder $query) => $query->where('assigned_to', $userId));

        // Add 'My Ticket' tab

        return $tabs;
    }

    private function getCount(string $assignedTo = null): int
    {
        $query = $this->getResource()::getModel()::query();

        if ($assignedTo) {
            $query->where('assigned_to', $assignedTo);
        }

        return $query->count();
    }

    private function getCountAssignedToMe(): int
    {
        $userId = Auth::id(); // Get the ID of the currently authenticated user
        return $this->getCount($userId);
    }

    private function getCountMyTickets(): int
    {
        $userId = Auth::id(); // Get the ID of the currently authenticated user
        $query = $this->getResource()::getModel()::query();
        $query->where('created_by', $userId);

        return $query->count();
    }
}
