<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BlogRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\BlogRepositoryInterface',
            'App\Repositories\BlogRepository'
        );
    }
}
