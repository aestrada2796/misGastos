<?php

namespace App\Filament\Resources\Expenses\Tables;

use App\Filament\Resources\Expenses\Tables\Summarizers\TotalSum;
use App\Services\ExpenseGroup\ListExpenseGroupOptionsService;
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

class ExpensesTable
{
    public static function configure(Table $table): Table
    {
        $expenseGroupService = app(ListExpenseGroupOptionsService::class);

        return $table
            ->columns([
                TextColumn::make('group.name')
                    ->label('Grupo de Gastos')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('date')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('quantity')
                    ->label('Cantidad')
                    ->sortable(),
                TextColumn::make('unit_price')
                    ->label('Precio Unitario')
                    ->money('MXN')
                    ->sortable(),
                TextColumn::make('total')
                    ->label('Total')
                    ->state(function ($record) {
                        return $record->quantity * $record->unit_price;
                    })
                    ->money('MXN')
                    ->sortable()
                    ->summarize(
                        TotalSum::make()
                            ->label('')
                            ->money('MXN')
                    ),
                TextColumn::make('period')
                    ->label('Período')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'single_payment' => 'Pago único',
                        'weekly' => 'Semanal',
                        'biweekly' => 'Quincenal',
                        'monthly' => 'Mensual',
                        'quarterly' => 'Trimestral',
                        'semiannually' => 'Semestral',
                        'annually' => 'Anual',
                        default => $state,
                    })
                    ->sortable(),
                CheckboxColumn::make('paid')
                    ->label('Pagado')
                    ->sortable(),
                CheckboxColumn::make('indefinite')
                    ->label('Indefinido')
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
                TernaryFilter::make('paid')
                    ->label('Pagado')
                    ->trueLabel('Solo pagados')
                    ->falseLabel('Solo no pagados')
                    ->placeholder('Todos'),
                TrashedFilter::make(),
            ])
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
