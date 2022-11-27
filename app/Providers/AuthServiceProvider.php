<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /*Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
        Passport::hashClientSecrets();
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));*/


        Passport::tokensCan([
            'customer'=>'For Customer',
            'admin'=>'For Admin',
            'agent'=>'For Agent'
        ]);

        Passport::personalAccessClient(
            config('passport.personal_access_client.id')
        );

        Passport::personalAccessClient(
            config('passport.personal_access_client.secret')
        );

    }
}
