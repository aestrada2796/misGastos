<?php
/**
 * @autor Adrian Estrada
 */

namespace App\Services\Distribution;

use App\Models\Distribution;
use Illuminate\Support\Facades\Validator;

class CreateDistributionService
{
    public function __invoke(array $data): Distribution
    {
        $validated = Validator::make($data, [
            'group_id' => 'required|uuid|exists:expense_groups,id',
            'income_id' => 'required|uuid|exists:incomes,id',
            'percentage' => 'required|numeric|min:0|max:100',
            'visible' => 'boolean',
        ])->validate();

        return Distribution::create($validated);
    }
}
