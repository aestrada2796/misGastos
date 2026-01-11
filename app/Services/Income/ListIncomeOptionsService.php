<?php
/**
 * @autor Adrian Estrada
 */

namespace App\Services\Income;

use App\Models\Income;

class ListIncomeOptionsService
{
    public function __invoke(): array
    {
        return Income::query()
            ->orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
    }
}
