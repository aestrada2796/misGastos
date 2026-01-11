<?php

namespace App\Filament\Resources\ExpenseGroups\Pages;

use App\Filament\Resources\ExpenseGroups\ExpenseGroupResource;
use App\Services\ExpenseGroup\DeleteExpenseGroupService;
use App\Services\ExpenseGroup\ForceDeleteExpenseGroupService;
use App\Services\ExpenseGroup\RestoreExpenseGroupService;
use App\Services\ExpenseGroup\UpdateExpenseGroupService;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditExpenseGroup extends EditRecord
{
    protected static string $resource = ExpenseGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->action(function () {
                    $service = app(DeleteExpenseGroupService::class);
                    $service($this->record);
                    $this->redirect($this->getResource()::getUrl('index'));
                }),
            ForceDeleteAction::make()
                ->action(function () {
                    $service = app(ForceDeleteExpenseGroupService::class);
                    $service($this->record);
                    $this->redirect($this->getResource()::getUrl('index'));
                }),
            RestoreAction::make()
                ->action(function () {
                    $service = app(RestoreExpenseGroupService::class);
                    $service($this->record);
                }),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $service = app(UpdateExpenseGroupService::class);
        return $service($record, $data);
    }
}
