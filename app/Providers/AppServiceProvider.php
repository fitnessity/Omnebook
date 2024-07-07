<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Encryption\Encrypter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->singleton('encrypter', function () {
                return new Encrypter(str_repeat('a', 16));
            });
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}


// Yes, it is possible to run Laravel in a development mode without encryption, although it's generally not recommended for security reasons. However, for debugging purposes or in certain development scenarios, you can bypass the encryption requirement. Here's how you can do it:

//     Modify your app/Providers/AppServiceProvider.php file:
    
//     Modified AppServiceProvider.phpClick to open code
//     This modification creates a dummy encrypter with a fixed key when the application is running in the local environment. This bypasses the need for an APP_KEY in your .env file.
    
//     In your .env file, ensure that APP_ENV=local: