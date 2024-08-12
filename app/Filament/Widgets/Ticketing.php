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
            $stats[] = Stat::make('Electrostatic Discharge', 'ESD Portal')
                ->description('Visit To Website')
                ->url('http://portal.siix-ems.co.id/esd')
                ->descriptionIcon('heroicon-m-arrow-right-end-on-rectangle')
                ->color('success');
        }

        if ($user->isAdminHr() || $user->isSuperAdmin() || $user->isSecurity() ) {
            $stats[] = Stat::make('Human Resource', 'HR Portal')
                ->description('Visit To Website')
                ->url('http://portal.siix-ems.co.id/hr')
                ->descriptionIcon('heroicon-m-arrow-right-end-on-rectangle')
                ->color('danger');
        }

        if ($user->isAdminGa() || $user->isSuperAdmin()) {
            $stats[] = Stat::make('General Affair', 'GA Portal')
                ->description('Visit To Website')
                ->url('http://portal.siix-ems.co.id/ga')
                ->descriptionIcon('heroicon-m-arrow-right-end-on-rectangle')
                ->color('warning');
        }

        if ($user->isAdminUtility() || $user->isSuperAdmin()) {
            $stats[] = Stat::make('Utility And Facility', 'Utility Portal')
                ->description('Visit To Website')
                ->url('http://portal.siix-ems.co.id/utility')
                ->descriptionIcon('heroicon-m-arrow-right-end-on-rectangle')
                ->color('info');
        }

        if ($user->isAdminUtility() || $user->isAdminEsd() || $user->isAdminHr() || $user->isAdminGa() || $user->isSuperAdmin()) {
            $stats[] = Stat::make('Stock Control Material', 'Stock Material')
                ->description('Visit To Website')
                ->url('http://portal.siix-ems.co.id/stock')
                ->descriptionIcon('heroicon-m-arrow-right-end-on-rectangle')
                ->color('info');
        }

        return $stats;
    }
}
