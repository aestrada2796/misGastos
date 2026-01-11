<?php
/**
 * @autor Adrian Estrada
 */

namespace App\Services\ExpenseGroup;

use App\Models\ExpenseGroup;
use Illuminate\Support\Facades\Validator;

class UpdateExpenseGroupService
{
    public function __invoke(ExpenseGroup $expenseGroup, array $data): ExpenseGroup
    {
        $validated = Validator::make($data, [
            'name' => 'sometimes|required|string|max:255',
            'color' => 'nullable|string|max:255',
        ])->validate();

        $expenseGroup->update($validated);
        return $expenseGroup->fresh();
    }
}
