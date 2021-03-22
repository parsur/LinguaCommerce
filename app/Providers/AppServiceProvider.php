<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Courses
        $vars['courses'] = \App\Models\Course::select('id','name')->get();
        // Articles
        $vars['articles'] = \App\Models\Article::select('id','title')->get();
        
        View::share($vars); 
        
    }
}
