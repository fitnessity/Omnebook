<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\TaskPolicy;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
// use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];


    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    
    {
        parent::registerPolicies($gate);

        $gate->define('timeline_access', function ($user) {
            return in_array($user->status, ["approved"]);
        });

        // Auth gates for: Profile
        $gate->define('profile_edit_access', function ($user) {
            return in_array($user->status, ["draft","approved", "rejected"]);
        });
        $gate->define('profile_view_access', function ($user) {
            return in_array($user->status, ["draft","approved", "rejected", "review_pending"]);
        });

        // Booking Access
        $gate->define('network_access', function ($user) {
            return in_array($user->status, ["approved"]);
        });

        // Booking Access
        $gate->define('booking_access', function ($user) {
            return in_array($user->status, ["approved"]);
        });

        $gate->define('matching_job_access', function ($user) {
            return (in_array($user->status, ["approved"]) && $user->role == "business");
        });
    }
}
