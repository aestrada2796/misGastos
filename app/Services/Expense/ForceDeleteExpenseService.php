<?php
/**
 * @autor Adrian Estrada
 */

namespace App\Services\Expense;

use App\Models\Expense;

class ForceDeleteExpenseService
{
    public function __invoke(Expense $expense): bool
    {
        return $expense->forceDelete();
    }
}
