<?php
/**
 * @autor Adrian Estrada
 */

namespace App\Services\Income;

use App\Models\Income;

class RestoreIncomeService
{
    public function __invoke(Income $income): bool
    {
        return $income->restore();
    }
}
