<?php
/**
 * @autor Adrian Estrada
 */

namespace App\Services\Income;

use App\Models\Income;
use Illuminate\Support\Facades\Validator;

class CreateIncomeService
{
    public function __invoke(array $data): Income
    {
        $validated = Validator::make($data, [
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'period' => 'required|in:single_payment,weekly,biweekly,monthly,quarterly,semiannually,annually',
        ])->validate();

        return Income::create($validated);
    }
}
