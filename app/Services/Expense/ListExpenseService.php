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

        if (isset($filters['group_id']) && !empty($filters['group_id'])) {
            $query->where('group_id', $filters['group_id']);
        }

        if (isset($filters['date_from']) && !empty($filters['date_from'])) {
            $query->whereDate('date', '>=', $filters['date_from']);
        }

        if (isset($filters['date_until']) && !empty($filters['date_until'])) {
            $query->whereDate('date', '<=', $filters['date_until']);
        }

        if (isset($filters['period']) && !empty($filters['period'])) {
            $query->where('period', $filters['period']);
        }

        if (isset($filters['paid']) && $filters['paid'] !== null && $filters['paid'] !== '') {
            $query->where('paid', (bool) $filters['paid']);
        }

        if (isset($filters['indefinite']) && $filters['indefinite'] !== null && $filters['indefinite'] !== '') {
            $query->where('indefinite', (bool) $filters['indefinite']);
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
