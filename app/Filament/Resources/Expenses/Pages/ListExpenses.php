<?php

namespace App\Filament\Resources\Expenses\Pages;

use App\Filament\Resources\Expenses\ExpenseResource;
use App\Services\Expense\ListExpenseService;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListExpenses extends ListRecords
{
    protected static string $resource = ExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        $service = app(ListExpenseService::class);

        $filterData = [];

        if ($this->tableFilters) {
            if (isset($this->tableFilters['group_id']['value']) && !empty($this->tableFilters['group_id']['value'])) {
                $filterData['group_id'] = $this->tableFilters['group_id']['value'];
            }

            if (isset($this->tableFilters['paid']['value']) && $this->tableFilters['paid']['value'] !== null && $this->tableFilters['paid']['value'] !== '') {
                $filterData['paid'] = (bool) $this->tableFilters['paid']['value'];
            }

            if (isset($this->tableFilters['trashed']['value']) && !empty($this->tableFilters['trashed']['value'])) {
                $filterData['trashed'] = $this->tableFilters['trashed']['value'];
            }
        }

        return $service($filterData);
    }

    public function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return parent::table($table)
            ->modifyQueryUsing(function (Builder $query): Builder {
                $service = app(ListExpenseService::class);

                $filterData = [];

                if ($this->tableFilters) {
                    if (isset($this->tableFilters['group_id']['value']) && !empty($this->tableFilters['group_id']['value'])) {
                        $filterData['group_id'] = $this->tableFilters['group_id']['value'];
                    }

                    if (isset($this->tableFilters['paid']['value']) && $this->tableFilters['paid']['value'] !== null && $this->tableFilters['paid']['value'] !== '') {
                        $filterData['paid'] = (bool) $this->tableFilters['paid']['value'];
                    }

                    if (isset($this->tableFilters['trashed']['value']) && !empty($this->tableFilters['trashed']['value'])) {
                        $filterData['trashed'] = $this->tableFilters['trashed']['value'];
                    }
                }

                return $service($filterData);
            });
    }
}
