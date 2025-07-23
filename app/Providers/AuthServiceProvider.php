<?php

namespace App\Providers;

use App\Models\Dealership;
use App\Models\Store;
use App\Models\User;
use App\Policies\DealershipPolicy;
use App\Policies\StorePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected array $policies = [
        Dealership::class => DealershipPolicy::class,
        Store::class => StorePolicy::class,
    ];

    public function boot(): void
    {
        Gate::define('access-scans', fn(User $user, int $storeId): bool => $user->hasPermission('scans', $storeId));

        Gate::define('access-audits', fn(User $user, int $storeId): bool => $user->hasPermission('audits', $storeId));

        Gate::define('access-vendors', fn(User $user, int $storeId): bool => $user->hasPermission('vendors', $storeId));

        Gate::define('access-courses', fn(User $user, int $storeId): bool => $user->hasPermission('courses', $storeId));

        Gate::define('admin-only', static fn (User $user): bool => $user->isAdmin());

        Gate::define('consultant-or-admin', static function (User $user): bool {
            if ($user->isAdmin()) {
                return true;
            }

            return $user->isConsultant();
        });

        Gate::define('manage-Dealerships', static function (User $user, int $dealershipId): bool {
            if ($user->isAdmin()) {
                return true;
            }

            if ($user->isConsultant()) {
                return $user->canAccessDealership($dealershipId);
            }

            return false;
        });
    }
}
