<?php
/**
 * @autor Adrian Estrada
 */

namespace App\Services\Income;

use App\Models\Income;
use Illuminate\Support\Facades\Validator;

class UpdateIncomeService
{
    public function __invoke(Income $income, array $data): Income
    {
        $validated = Validator::make($data, [
            'name' => 'sometimes|required|string|max:255',
            'date' => 'sometimes|required|date',
            'amount' => 'sometimes|required|numeric|min:0',
            'period' => 'sometimes|required|in:single_payment,weekly,biweekly,monthly,quarterly,semiannually,annually',
        ])->validate();

        $income->update($validated);
        return $income->fresh();
    }
}
