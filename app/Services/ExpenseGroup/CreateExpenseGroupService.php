<?php
/**
 * @autor Adrian Estrada
 */

namespace App\Services\ExpenseGroup;

use App\Models\ExpenseGroup;
use Illuminate\Support\Facades\Validator;

class CreateExpenseGroupService
{
    public function __invoke(array $data): ExpenseGroup
    {
        $validated = Validator::make($data, [
            'name' => 'required|string|max:255',
            'color' => 'nullable|string|max:255',
        ])->validate();

        return ExpenseGroup::create($validated);
    }
}
