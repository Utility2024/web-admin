<?php

namespace App\Filament\Hr\Widgets;

use Filament\Tables;
use App\Models\Employee;
use Filament\Tables\Table;
use App\Models\ComelateEmployee;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class FComelateTable extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Employee Comelate Count';

    public function table(Table $table): Table
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the user has the 'SECURITY' role using the isSecurity() method
        if ($user && $user->isSecurity()) {
            // If the user has the 'SECURITY' role, return an empty table or a placeholder
            return $table->query(Employee::query())->columns([]);
        }

        // If the user does not have the 'SECURITY' role, show the table
        return $table
            ->query(
                Employee::query()
            )
            ->columns([
                Tables\Columns\TextColumn::make('user_login')
                    ->label('NIK')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('Display_Name')
                    ->label('Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Departement')
                    ->label('Department')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Last_Route')
                    ->label('Last Route')
                    ->searchable(),
                Tables\Columns\TextColumn::make('related_count')
                    ->label('Comelate Count')
                    ->badge()
                    ->color('primary')
                    // ->sortable()
                    ->getStateUsing(function ($record) {
                        return ComelateEmployee::where('nik', $record->user_login)->count();
                    })
            ]);
            // ->defaultSort('related_count', 'desc');
    }
}
