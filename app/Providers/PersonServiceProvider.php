<?php

namespace App\Providers;

use App\Person;
use Illuminate\Support\ServiceProvider;

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
