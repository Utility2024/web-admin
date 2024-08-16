<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class Ticketing extends BaseWidget
{
    protected function getStats(): array
    {
        $user = Auth::user(); // Mengambil pengguna yang saat ini sedang login

        // Kontrol akses berdasarkan role pengguna
        $stats = [];

        if ($user->isAdminEsd() || $user->isSuperAdmin() || $user->isUser() ) {
            $stats[] = Stat::make('ESD', 'Electrostatic Discharge')
                ->description('More Info')
                ->url('http://portal.siix-ems.co.id/esd')
                ->descriptionIcon('heroicon-m-arrow-right-end-on-rectangle')
                ->color('success');
                // ->columnSpan(1);
        }

        if ($user->isAdminHr() || $user->isSuperAdmin() || $user->isSecurity() ) {
            $stats[] = Stat::make('HR', 'Human Resource')
                ->description('More Info')
                ->url('http://portal.siix-ems.co.id/hr')
                ->descriptionIcon('heroicon-m-arrow-right-end-on-rectangle')
                ->color('danger');
        }

        if ($user->isAdminGa() || $user->isSuperAdmin() || $user->isUser()) {
            $stats[] = Stat::make('GA', 'General Affair')
                ->description('More Info')
                ->url('http://portal.siix-ems.co.id/ga')
                ->descriptionIcon('heroicon-m-arrow-right-end-on-rectangle')
                ->color('warning');
        }

        if ($user->isAdminUtility() || $user->isSuperAdmin()) {
            $stats[] = Stat::make('Building', 'Utility And Facility')
                ->description('More Info')
                ->url('http://portal.siix-ems.co.id/utility')
                ->descriptionIcon('heroicon-m-arrow-right-end-on-rectangle')
                ->color('info');
        }

        if ($user->isAdminUtility() || $user->isAdminEsd() || $user->isAdminHr() || $user->isAdminGa() || $user->isSuperAdmin()) {
            $stats[] = Stat::make('Stock Control Material', 'Stock Material')
                ->description('More Info')
                ->url('http://portal.siix-ems.co.id/stock')
                ->descriptionIcon('heroicon-m-arrow-right-end-on-rectangle')
                ->color('info');
        }

        return $stats;
    }
}
