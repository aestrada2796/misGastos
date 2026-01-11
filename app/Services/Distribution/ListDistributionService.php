<?php
/**
 * @autor Adrian Estrada
 */

namespace App\Services\Distribution;

use App\Models\Distribution;
use Illuminate\Database\Eloquent\Builder;

class ListDistributionService
{
    public function __invoke(array $filters = []): Builder
    {
        $query = Distribution::query()
            ->with(['group', 'income']);

        // Aplicar filtros
        if (isset($filters['group_id'])) {
            $query->where('group_id', $filters['group_id']);
        }

        if (isset($filters['income_id'])) {
            $query->where('income_id', $filters['income_id']);
        }

        if (isset($filters['visible']) && $filters['visible'] !== null) {
            $query->where('visible', $filters['visible']);
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
