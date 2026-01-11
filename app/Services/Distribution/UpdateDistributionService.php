<?php
/**
 * @autor Adrian Estrada
 */

namespace App\Services\Distribution;

use App\Models\Distribution;
use Illuminate\Support\Facades\Validator;

class UpdateDistributionService
{
    public function __invoke(Distribution $distribution, array $data): Distribution
    {
        $validated = Validator::make($data, [
            'group_id' => 'sometimes|required|uuid|exists:expense_groups,id',
            'income_id' => 'sometimes|required|uuid|exists:incomes,id',
            'percentage' => 'sometimes|required|numeric|min:0|max:100',
            'visible' => 'sometimes|boolean',
        ])->validate();

        $distribution->update($validated);
        return $distribution->fresh();
    }
}
