<?php

namespace App\Filament\Resources\Distributions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DistributionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('group_id')
                    ->label('Grupo de Gastos')
                    ->relationship('group', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->label('Nombre')
                            ->required(),
                    ]),
                Select::make('income_id')
                    ->label('Ingreso')
                    ->relationship('income', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->label('Nombre')
                            ->required(),
                        TextInput::make('amount')
                            ->label('Monto')
                            ->numeric()
                            ->required(),
                    ]),
                TextInput::make('percentage')
                    ->label('Porcentaje')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->step(0.01)
                    ->suffix('%')
                    ->required()
                    ->default(0),
            ]);
    }
}
