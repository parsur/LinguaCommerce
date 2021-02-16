<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
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
        // Categories
        $vars['categories'] = Category::select('name','id')->get();
        // Sub Categories
        $vars['subCategories'] = SubCategory::select('name','id')->get();
        // Sub Categories
        $vars['courses'] = COurse::select('name','id')->get();

        View::share($vars); 
    }
}
