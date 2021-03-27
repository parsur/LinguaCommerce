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
        /**
         * Somehow PHP is not able to write in default /tmp directory and SwiftMailer was failing.
         * To overcome this situation, we set the TMPDIR environment variable to a new value.
         */
        // if (class_exists('Swift_Preferences')) {
        //     \Swift_Preferences::getInstance()->setTempDir(storage_path().'/tmp');
        // } else {
        //     \Log::warning('Class Swift_Preferences does not exists');
        // }

        // $this->app->bind('path.public', function() {
        //     return '/home/h151778/public_html';
        // });
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
