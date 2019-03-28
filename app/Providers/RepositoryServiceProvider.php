<?php

namespace CodeFlix\Providers;

use CodeFlix\Repositories\UserRepository;
use CodeFlix\Repositories\UserRepositoryEloquent;

use CodeFlix\Repositories\CategoriasRepositoryEloquent;
use CodeFlix\Repositories\CategoriasRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(CategoriasRepository::class, CategoriasRepositoryEloquent::class);
    }

}
