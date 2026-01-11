<?php
/**
 * @autor Adrian Estrada
 */

namespace App\Services\Expense;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Builder;

class ListExpenseService
{
    public function __invoke(array $filters = []): Builder
    {
        $query = Expense::query()
            ->with(['group']);

        if (isset($filters['group_id'])) {
            $query->where('group_id', $filters['group_id']);
        }

        if (isset($filters['paid']) && $filters['paid'] !== null) {
            $query->where('paid', $filters['paid']);
        }

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
