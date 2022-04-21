<?php

namespace App\Providers;

use App\Repository\Kendaraan\EloquentKendaraanRepository;
use App\Repository\Kendaraan\KendaraanRepository;
use App\Repository\Motor\EloquentMotorRepository;
use App\Repository\Motor\MotorRepository;
use App\Repository\Mobil\EloquentMobilRepository;
use App\Repository\Mobil\MobilRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(KendaraanRepository::class, EloquentKendaraanRepository::class);
        $this->app->bind(MotorRepository::class, EloquentMotorRepository::class);
        $this->app->bind(MobilRepository::class, EloquentMobilRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
