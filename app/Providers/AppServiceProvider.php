<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use View;
use App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Interfaces\NoticeInterface',
            'App\Repository\NoticeRepository',
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*',function($view){
            $view->with('website_info',DB::table('company_informations')->where('id',1)->first());
        });
    }
}
