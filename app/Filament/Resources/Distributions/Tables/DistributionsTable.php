<?php

namespace App\Filament\Resources\Distributions\Tables;

use App\Services\ExpenseGroup\ListExpenseGroupOptionsService;
use App\Services\Income\ListIncomeOptionsService;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class DistributionsTable
{
    public static function configure(Table $table): Table
    {
        $expenseGroupService = app(ListExpenseGroupOptionsService::class);
        $incomeService = app(ListIncomeOptionsService::class);

        return $table
            ->columns([
                TextColumn::make('group.name')
                    ->label('Grupo de Gastos')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('income.name')
                    ->label('Ingreso')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('percentage')
                    ->label('Porcentaje')
                    ->formatStateUsing(fn ($state) => number_format($state, 2) . '%')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('group_id')
                    ->label('Grupo de Gastos')
                    ->options($expenseGroupService())
                    ->searchable(),
                SelectFilter::make('income_id')
                    ->label('Ingreso')
                    ->options($incomeService())
                    ->searchable(),
                TernaryFilter::make('visible')
                    ->label('Visible')
                    ->trueLabel('Solo visibles')
                    ->falseLabel('Solo ocultos')
                    ->placeholder('Todos'),
                TrashedFilter::make(),
            ])
            ->filtersFormColumns(2)
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
