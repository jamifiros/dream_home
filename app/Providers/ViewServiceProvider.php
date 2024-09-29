<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\ProjectRequest;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Attach data to all views extending layout.blade.php
        View::composer('admin.layout', function ($view) {
            $pendingRequestsCount = ProjectRequest::where('status', 'pending')->count();
            $view->with('pendingRequestsCount', $pendingRequestsCount);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
