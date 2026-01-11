<?php
/**
 * @autor Adrian Estrada
 */

namespace App\Services\ExpenseGroup;

use App\Models\ExpenseGroup;

class ForceDeleteExpenseGroupService
{
    public function __invoke(ExpenseGroup $expenseGroup): bool
    {
        return $expenseGroup->forceDelete();
    }
}
