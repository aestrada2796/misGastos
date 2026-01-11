<?php

namespace App\Filament\Resources\Incomes\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class IncomeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),
                DateTimePicker::make('date')
                    ->label('Fecha')
                    ->required()
                    ->displayFormat('d/m/Y')
                    ->native(false),
                TextInput::make('amount')
                    ->label('Monto')
                    ->numeric()
                    ->prefix('$')
                    ->default(0)
                    ->required(),
                Select::make('period')
                    ->label('Período')
                    ->options([
                        'single_payment' => 'Pago único',
                        'weekly' => 'Semanal',
                        'biweekly' => 'Quincenal',
                        'monthly' => 'Mensual',
                        'quarterly' => 'Trimestral',
                        'semiannually' => 'Semestral',
                        'annually' => 'Anual',
                    ])
                    ->default('single_payment')
                    ->required(),
            ]);
    }
}
