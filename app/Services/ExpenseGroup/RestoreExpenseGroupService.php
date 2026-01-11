<?php
/**
 * @autor Adrian Estrada
 */

namespace App\Services\ExpenseGroup;

use App\Models\ExpenseGroup;

class RestoreExpenseGroupService
{
    public function __invoke(ExpenseGroup $expenseGroup): bool
    {
        return $expenseGroup->restore();
    }
}
