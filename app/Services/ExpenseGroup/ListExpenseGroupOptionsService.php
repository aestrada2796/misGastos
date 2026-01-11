<?php
/**
 * @autor Adrian Estrada
 */

namespace App\Services\ExpenseGroup;

use App\Models\ExpenseGroup;

class ListExpenseGroupOptionsService
{
    public function __invoke(): array
    {
        return ExpenseGroup::query()
            ->orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
    }
}
