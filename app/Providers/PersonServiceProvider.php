<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Person;

class PersonServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind('Person', Person::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
