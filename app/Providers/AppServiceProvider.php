<?php

namespace App\Providers;

use App\Http\Controllers\AgentController;
use App\Models\Agent;
use App\Models\Student;
use App\Observers\AgentObserver;
use App\Observers\StudentObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
        Student::observe(StudentObserver::class);
        Agent::observe(AgentObserver::class);
    }
}
