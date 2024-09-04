<?php

namespace App\Filament\Ticket\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Ticket; // Sesuaikan dengan lokasi model Ticket
use Illuminate\Support\Facades\Auth;

class ATicketingWidets extends BaseWidget
{
    protected function getStats(): array
    {
        $userId = Auth::id(); // Mendapatkan ID pengguna yang sedang login
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        
        // Menghitung jumlah total tiket yang terkait dengan pengguna, baik yang dibuat oleh pengguna maupun yang ditugaskan kepada pengguna
        $allTicketsCount = Ticket::where('created_by', $userId)
                            ->orWhere('assigned_to', $userId)
                            ->count();

        // Menghitung jumlah tiket untuk setiap status, berdasarkan pengguna yang login
        $openCount = Ticket::where(function ($query) use ($userId) {
                                $query->where('created_by', $userId);
                            })
                            ->where('status', 'Open')
                            ->count();

        $inProgressCount = Ticket::where(function ($query) use ($userId) {
                                $query->where('created_by', $userId);
                            })
                            ->where('status', 'In Progress')
                            ->count();

        $closedCount = Ticket::where(function ($query) use ($userId) {
                                $query->where('created_by', $userId);
                            })
                            ->where('status', 'Closed')
                            ->count();

        $stats = [
            Stat::make('My Ticket Open', $this->formatNumber($openCount))
                ->description("Total Open Tickets")
                ->descriptionIcon('heroicon-m-information-circle')
                ->url('http://portal.siix-ems.co.id/ticket/tickets?tableFilters[status][value]=Open&activeTab=My+Ticket')
                ->color('primary'),

            Stat::make('My Ticket In Progress', $this->formatNumber($inProgressCount))
                ->description("Total Tickets In Progress")
                ->descriptionIcon('heroicon-m-clock')
                ->url('http://portal.siix-ems.co.id/ticket/tickets?tableFilters[status][value]=In+Progress&activeTab=My+Ticket')
                ->color('warning'),

            Stat::make('My Ticket Closed', $this->formatNumber($closedCount))
                ->description("Total Closed Tickets")
                ->descriptionIcon('heroicon-m-check-circle')
                ->url('http://portal.siix-ems.co.id/ticket/tickets?tableFilters[status][value]=Closed&activeTab=My+Ticket')
                ->color('success'),
        ];

        // Menambahkan statistik "All My Ticket" hanya jika pengguna adalah SuperAdmin
        if ($user->isSuperAdmin()) {
            $stats = array_merge([
                Stat::make('All Ticket', $this->formatNumber($allTicketsCount))
                    ->description("Total Number Of Tickets")
                    ->descriptionIcon('heroicon-m-ticket')
                    ->url('http://portal.siix-ems.co.id/ticket/tickets')
                    ->color('secondary'),
            ], $stats);
        }

        return $stats;
    }

    private function formatNumber(int $number): string
    {
        // Format nomor sesuai kebutuhan, misalnya dengan pemisah ribuan
        return number_format($number);
    }
}
