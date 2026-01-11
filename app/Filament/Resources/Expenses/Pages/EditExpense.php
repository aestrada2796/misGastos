<?php

namespace App\Filament\Resources\Expenses\Pages;

use App\Filament\Resources\Expenses\ExpenseResource;
use App\Services\Expense\DeleteExpenseService;
use App\Services\Expense\ForceDeleteExpenseService;
use App\Services\Expense\RestoreExpenseService;
use App\Services\Expense\UpdateExpenseService;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditExpense extends EditRecord
{
    protected static string $resource = ExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->action(function () {
                    $service = app(DeleteExpenseService::class);
                    $service($this->record);
                    $this->redirect($this->getResource()::getUrl('index'));
                }),
            ForceDeleteAction::make()
                ->action(function () {
                    $service = app(ForceDeleteExpenseService::class);
                    $service($this->record);
                    $this->redirect($this->getResource()::getUrl('index'));
                }),
            RestoreAction::make()
                ->action(function () {
                    $service = app(RestoreExpenseService::class);
                    $service($this->record);
                }),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $service = app(UpdateExpenseService::class);
        return $service($record, $data);
    }
}
