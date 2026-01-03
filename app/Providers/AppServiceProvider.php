<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CompanyRepositoryInterface;
use App\Repositories\CompanyRepository;
use App\Repositories\EmployeeRepositoryInterface;
use App\Repositories\EmployeeRepository;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        // Bind interface ke implementasi
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        // Bind interface ke implementasi
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
         Paginator::useBootstrapFive();
    }
}
