<?php

namespace App\Actions\AdminPanel;

use App\Models\PackagePrice;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdatePackagePrice
{
    use AsAction;

    public function handle(PackagePrice $packagePrice, array $data): PackagePrice
    {
        // If the on_promotion flag is set to false, clear the promotion dates
        if ($data['on_promotion'] === false) {
            $data['promotion_starts_at'] = null;
            $data['promotion_ends_at'] = null;
        }

        $packagePrice->update($data);

        return $packagePrice;
    }
}
