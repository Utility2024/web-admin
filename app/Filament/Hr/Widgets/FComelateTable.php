<?php

namespace App\Filament\Hr\Widgets;

use Filament\Tables;
use App\Models\ComelateCount; // Menggunakan model ComelateCount
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Indicator;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;

class FComelateTable extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Comelate Employees Count';

    public function table(Table $table): Table
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the user has the 'SECURITY' role using the isSecurity() method
        if ($user && $user->isSecurity()) {
            // If the user has the 'SECURITY' role, return an empty table or a placeholder
            return $table->query(ComelateCount::query())->columns([]);
        }

        // If the user does not have the 'SECURITY' role, show the table
        return $table
            ->query(ComelateCount::query()) // Menggunakan model ComelateCount
            ->columns([
                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department')
                    ->label('Department')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('count_comelate')
                    ->label('Comelate Count') // Sesuaikan label dengan kolom model
                    ->sortable(),
            ])
            ->defaultSort('count_comelate', 'desc');
    }
}
