<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TCG\Voyager\Facades\Voyager;

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
        Voyager::addAction(\App\Actions\QrGenerate::class);
        Voyager::addAction(\App\Actions\ReSendMail::class);
        Voyager::addAction(\App\Actions\ToggleApproved::class);
        Voyager::addAction(\App\Actions\UsersExport::class);
    }
}
