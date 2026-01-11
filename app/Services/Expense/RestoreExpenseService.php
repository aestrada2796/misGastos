<?php
/**
 * @autor Adrian Estrada
 */

namespace App\Services\Expense;

use App\Models\Expense;

class RestoreExpenseService
{
    public function __invoke(Expense $expense): bool
    {
        return $expense->restore();
    }
}
