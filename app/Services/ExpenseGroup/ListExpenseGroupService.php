<?php
/**
 * @autor Adrian Estrada
 */

namespace App\Services\ExpenseGroup;

use App\Models\ExpenseGroup;
use Illuminate\Database\Eloquent\Builder;

class ListExpenseGroupService
{
    public function __invoke(array $filters = []): Builder
    {
        $query = ExpenseGroup::query();

        // Aplicar filtros si es necesario en el futuro
        if (isset($filters['trashed'])) {
            match ($filters['trashed']) {
                'only' => $query->onlyTrashed(),
                'with' => $query->withTrashed(),
                default => $query->withoutTrashed(),
            };
        }

        return $query;
    }
}
