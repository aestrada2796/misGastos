<?php

namespace App\Filament\Resources\Expenses\Tables\Summarizers;

use Filament\Tables\Columns\Summarizers\Sum;

class TotalSum extends Sum
{
    public function getSelectStatements(string $column): array
    {
        return [
            $this->getSelectAlias() => 'SUM(quantity * unit_price)',
        ];
    }
}
