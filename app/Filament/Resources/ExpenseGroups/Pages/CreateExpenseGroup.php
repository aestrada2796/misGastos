<?php

namespace App\Filament\Resources\ExpenseGroups\Pages;

use App\Filament\Resources\ExpenseGroups\ExpenseGroupResource;
use App\Services\ExpenseGroup\CreateExpenseGroupService;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateExpenseGroup extends CreateRecord
{
    protected static string $resource = ExpenseGroupResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $service = app(CreateExpenseGroupService::class);
        return $service($data);
    }
}
