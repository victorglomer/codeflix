<?php

namespace CodeFlix\Providers;

use CodeFlix\Models\Video;
use Dingo\Api\Exception\Handler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Video::updated(function ($video) {
           if(!$video->completed){
               if ($video->thumb != null &&
                   $video->file != null &&
                   $video->duration != null
               ) {
                   $video->completed = 1;
                   $video->save();
               }
           }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(DuskServiceProvider::class);
        }
        //

        $handler = app(Handler::class);
        $handler->register(function(AuthenticationException $exception) {
           return response()->json(['error'=>'Unauthenticated'], 401);
        });
    }
}
