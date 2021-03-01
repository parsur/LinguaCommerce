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
        // Categories
        $vars['categories'] = \App\Models\Category::select('id', 'name')->get();
        // Sub Category
        $vars['subCategories'] = \App\Models\SubCategory::select('id', 'name')->get();
        
        View::share($vars); 
        
    }
}
