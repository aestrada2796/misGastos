<?php

namespace App\Filament\Resources\Expenses\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ExpenseForm
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
                    ->required(),
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),
                DateTimePicker::make('date')
                    ->label('Fecha')
                    ->required()
                    ->displayFormat('d/m/Y')
                    ->native(false),
                DateTimePicker::make('end_date')
                    ->label('Fecha Fin')
                    ->displayFormat('d/m/Y')
                    ->native(false)
                    ->visible(fn ($get) => !$get('indefinite')),
                TimePicker::make('time')
                    ->label('Hora'),
                TimePicker::make('end_time')
                    ->label('Hora Fin')
                    ->visible(fn ($get) => !$get('indefinite')),
                TextInput::make('quantity')
                    ->label('Cantidad')
                    ->numeric()
                    ->default(1)
                    ->required(),
                TextInput::make('unit_price')
                    ->label('Precio Unitario')
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
                Toggle::make('paid')
                    ->label('Pagado')
                    ->default(false),
                Toggle::make('indefinite')
                    ->label('Indefinido')
                    ->default(false),
            ]);
    }
}
