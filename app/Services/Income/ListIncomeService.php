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
