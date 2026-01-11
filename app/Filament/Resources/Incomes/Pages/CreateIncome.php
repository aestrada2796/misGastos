<?php

namespace App\Filament\Resources\Incomes\Pages;

use App\Filament\Resources\Incomes\IncomeResource;
use App\Services\Income\CreateIncomeService;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateIncome extends CreateRecord
{
    protected static string $resource = IncomeResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $service = app(CreateIncomeService::class);
        return $service($data);
    }
}
