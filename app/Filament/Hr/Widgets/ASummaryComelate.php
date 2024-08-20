<?php

namespace App\Filament\Hr\Widgets;

use App\Models\ComelateEmployee;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class ASummaryComelate extends BaseWidget
{
    protected function getStats(): array
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the user has the 'SECURITY' role using the isSecurity() method
        if ($user && $user->isSecurity()) {
            // If the user has the 'SECURITY' role, return an empty array to hide the widget
            return [];
        }

        // If the user does not have the 'SECURITY' role, show the stats
        $totalComelate = ComelateEmployee::count();
        $totalDepartments = ComelateEmployee::distinct('department')->count('department');

        return [
            Stat::make('Total Comelate', $totalComelate)
                ->description('Total jumlah data terlambat'),
            Stat::make('Total Departments', $totalDepartments)
                ->description('Total jumlah department yang terdaftar'),
        ];
    }
}
