<?php

namespace App\Filament\Resources\Incomes\Pages;

use App\Filament\Resources\Incomes\IncomeResource;
use App\Services\Income\DeleteIncomeService;
use App\Services\Income\ForceDeleteIncomeService;
use App\Services\Income\RestoreIncomeService;
use App\Services\Income\UpdateIncomeService;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditIncome extends EditRecord
{
    protected static string $resource = IncomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->action(function () {
                    $service = app(DeleteIncomeService::class);
                    $service($this->record);
                    $this->redirect($this->getResource()::getUrl('index'));
                }),
            ForceDeleteAction::make()
                ->action(function () {
                    $service = app(ForceDeleteIncomeService::class);
                    $service($this->record);
                    $this->redirect($this->getResource()::getUrl('index'));
                }),
            RestoreAction::make()
                ->action(function () {
                    $service = app(RestoreIncomeService::class);
                    $service($this->record);
                }),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $service = app(UpdateIncomeService::class);
        return $service($record, $data);
    }
}
