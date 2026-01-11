<?php

namespace App\Filament\Resources\Incomes\Pages;

use App\Filament\Resources\Incomes\IncomeResource;
use App\Services\Income\ListIncomeService;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListIncomes extends ListRecords
{
    protected static string $resource = IncomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        $service = app(ListIncomeService::class);

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
                $service = app(ListIncomeService::class);

                $filterData = [];

                if ($this->tableFilters) {
                    if (isset($this->tableFilters['date']['value'])) {
                        if (isset($this->tableFilters['date']['value']['date_from']) && !empty($this->tableFilters['date']['value']['date_from'])) {
                            $filterData['date_from'] = $this->tableFilters['date']['value']['date_from'];
                        }
                        if (isset($this->tableFilters['date']['value']['date_until']) && !empty($this->tableFilters['date']['value']['date_until'])) {
                            $filterData['date_until'] = $this->tableFilters['date']['value']['date_until'];
                        }
                    }

                    if (isset($this->tableFilters['period']['value']) && !empty($this->tableFilters['period']['value'])) {
                        $filterData['period'] = $this->tableFilters['period']['value'];
                    }

                    if (isset($this->tableFilters['amount']['value'])) {
                        if (isset($this->tableFilters['amount']['value']['amount_from']) && !empty($this->tableFilters['amount']['value']['amount_from'])) {
                            $filterData['amount_from'] = $this->tableFilters['amount']['value']['amount_from'];
                        }
                        if (isset($this->tableFilters['amount']['value']['amount_until']) && !empty($this->tableFilters['amount']['value']['amount_until'])) {
                            $filterData['amount_until'] = $this->tableFilters['amount']['value']['amount_until'];
                        }
                    }

                    if (isset($this->tableFilters['trashed']['value']) && !empty($this->tableFilters['trashed']['value'])) {
                        $filterData['trashed'] = $this->tableFilters['trashed']['value'];
                    }
                }

                return $service($filterData);
            });
    }
}
