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
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

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
                    ->sortable()
                    ->summarize(
                        Sum::make()
                            ->label('')
                            ->money('MXN')
                    ),
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
                        'bimonthly' => 'Bimestral',
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
                Filter::make('date')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('date_from')
                            ->label('Fecha desde'),
                        \Filament\Forms\Components\DatePicker::make('date_until')
                            ->label('Fecha hasta'),
                    ])
                    ->columns(2)
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['date_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                            )
                            ->when(
                                $data['date_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                            );
                    }),
                SelectFilter::make('period')
                    ->label('Período')
                    ->options([
                        'single_payment' => 'Pago único',
                        'weekly' => 'Semanal',
                        'biweekly' => 'Quincenal',
                        'monthly' => 'Mensual',
                        'bimonthly' => 'Bimestral',
                        'quarterly' => 'Trimestral',
                        'semiannually' => 'Semestral',
                        'annually' => 'Anual',
                    ])
                    ->searchable(),
                TernaryFilter::make('paid')
                    ->label('Pagado')
                    ->trueLabel('Solo pagados')
                    ->falseLabel('Solo no pagados')
                    ->placeholder('Todos'),
                TernaryFilter::make('indefinite')
                    ->label('Indefinido')
                    ->trueLabel('Solo indefinidos')
                    ->falseLabel('Solo con fecha fin')
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
