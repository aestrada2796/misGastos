<?php
/**
 * @autor Adrian Estrada
 */

namespace App\Services\Income;

use App\Models\Income;
use Illuminate\Database\Eloquent\Builder;

class ListIncomeService
{
    public function __invoke(array $filters = []): Builder
    {
        $query = Income::query();

        if (isset($filters['date_from']) && !empty($filters['date_from'])) {
            $query->whereDate('date', '>=', $filters['date_from']);
        }

        if (isset($filters['date_until']) && !empty($filters['date_until'])) {
            $query->whereDate('date', '<=', $filters['date_until']);
        }

        if (isset($filters['period']) && !empty($filters['period'])) {
            $query->where('period', $filters['period']);
        }

        if (isset($filters['amount_from']) && !empty($filters['amount_from'])) {
            $query->where('amount', '>=', $filters['amount_from']);
        }

        if (isset($filters['amount_until']) && !empty($filters['amount_until'])) {
            $query->where('amount', '<=', $filters['amount_until']);
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
