<?php

namespace App\Filament\Resources\ExpenseGroups\Pages;

use App\Filament\Resources\ExpenseGroups\ExpenseGroupResource;
use App\Services\ExpenseGroup\ListExpenseGroupService;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListExpenseGroups extends ListRecords
{
    protected static string $resource = ExpenseGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        $service = app(ListExpenseGroupService::class);

        $filterData = [];

        if ($this->tableFilters) {
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
                $service = app(ListExpenseGroupService::class);

                $filterData = [];

                if ($this->tableFilters) {
                    if (isset($this->tableFilters['trashed']['value']) && !empty($this->tableFilters['trashed']['value'])) {
                        $filterData['trashed'] = $this->tableFilters['trashed']['value'];
                    }
                }

                return $service($filterData);
            });
    }
}
