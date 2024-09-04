<?php

namespace App\Filament\Ticket\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BSummaryTicketing extends ApexChartWidget
{
    protected static string $chartId = 'summaryTicketing';
    protected static ?string $heading = 'Summary Ticketing';

    protected function getOptions(): array
    {
        $userId = Auth::id();
        $currentYear = Carbon::now()->year;

        $priorityColors = [
            'Low' => '#6c757d',       // Gray
            'Medium' => '#ffc107',    // Yellow
            'Urgent' => '#dc3545',    // Red
            'Critical' => '#007bff',  // Blue
        ];

        // Initialize arrays for ticket counts and colors per priority per month
        $monthlyTicketCounts = [];
        $monthlyColors = [];

        foreach ($priorityColors as $priority => $color) {
            $monthlyTicketCounts[$priority] = array_fill(0, 12, 0);
            $monthlyColors[$priority] = array_fill(0, 12, $color);
        }

        // Query to get ticket count and priorities per month
        $tickets = Ticket::where('created_by', $userId)
            ->whereYear('created_at', $currentYear)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count, priority')
            ->groupBy('month', 'priority')
            ->get();

        foreach ($tickets as $ticket) {
            $monthIndex = $ticket->month - 1;
            $monthlyTicketCounts[$ticket->priority][$monthIndex] = $ticket->count;
        }

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
                'stacked' => true, // Stack bars for each priority
            ],
            'series' => array_map(function ($priority) use ($monthlyTicketCounts) {
                return [
                    'name' => $priority,
                    'data' => $monthlyTicketCounts[$priority],
                ];
            }, array_keys($priorityColors)),
            'xaxis' => [
                'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => array_values($priorityColors),
        ];
    }
}
