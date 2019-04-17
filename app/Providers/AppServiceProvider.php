<?php

namespace CodeFlix\Providers;

use CodeFlix\Models\Video;
use Illuminate\Support\ServiceProvider;

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
               if ($video->thumb != null && $video->file != null) {
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
        }
        //
    }
}
