<?php

namespace App\Providers;

use App\Models\Dealership;
use App\Models\User;
use App\Policies\DealershipPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Dealership::class => DealershipPolicy::class,
    ];

    public function boot(): void
    {
        Gate::define('admin-only', static fn(User $user): bool => $user->isAdmin());

        Gate::define('consultant-or-admin', static function (User $user): bool {
            if ($user->isAdmin()) {
                return true;
            }
            return $user->isConsultant();
        });

        Gate::define('manage-dealership', static function (User $user, int $dealershipId): bool {
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
