<?php

namespace App\Filament\Resources\Distributions\Pages;

use App\Filament\Resources\Distributions\DistributionResource;
use App\Services\Distribution\DeleteDistributionService;
use App\Services\Distribution\ForceDeleteDistributionService;
use App\Services\Distribution\RestoreDistributionService;
use App\Services\Distribution\UpdateDistributionService;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditDistribution extends EditRecord
{
    protected static string $resource = DistributionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->action(function () {
                    $service = app(DeleteDistributionService::class);
                    $service($this->record);
                    $this->redirect($this->getResource()::getUrl('index'));
                }),
            ForceDeleteAction::make()
                ->action(function () {
                    $service = app(ForceDeleteDistributionService::class);
                    $service($this->record);
                    $this->redirect($this->getResource()::getUrl('index'));
                }),
            RestoreAction::make()
                ->action(function () {
                    $service = app(RestoreDistributionService::class);
                    $service($this->record);
                }),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $service = app(UpdateDistributionService::class);
        return $service($record, $data);
    }
}
