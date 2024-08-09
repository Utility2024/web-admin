<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Ticketing extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Electrosatic Discharge', 'ESD Portal')
                ->description('Visit To Website')
                ->url('http://127.0.0.1:8000/esd')
                ->descriptionIcon('heroicon-m-arrow-right-end-on-rectangle')
                ->color('success'),
            Stat::make('Human Resource', 'HR Portal')
                ->description('Visit To Website')
                ->url('http://127.0.0.1:8000/hr')
                ->descriptionIcon('heroicon-m-arrow-right-end-on-rectangle')
                ->color('danger'),
            Stat::make('General Afair', 'GA Portal')
                ->description('Visit To Website')
                ->url('http://127.0.0.1:8000/ga')
                ->descriptionIcon('heroicon-m-arrow-right-end-on-rectangle')
                ->color('warning'),
            Stat::make('Utility And Facility', 'Utility Portal')
                ->description('Visit To Website')
                ->url('http://127.0.0.1:8000/utility')
                ->descriptionIcon('heroicon-m-arrow-right-end-on-rectangle')
                ->color('info'),
            Stat::make('Stock Control Material', 'Stock Material')
                ->description('Visit To Website')
                ->url('http://127.0.0.1:8000/stock')
                ->descriptionIcon('heroicon-m-arrow-right-end-on-rectangle')
                ->color('info'),
        ];
    }
}
