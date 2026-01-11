<?php
/**
 * @autor Adrian Estrada
 */

namespace App\Services\Distribution;

use App\Models\Distribution;

class RestoreDistributionService
{
    public function __invoke(Distribution $distribution): bool
    {
        return $distribution->restore();
    }
}
