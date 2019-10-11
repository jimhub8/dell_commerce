<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\AttributeContract;
use App\Repositories\AttributeRepository;
use App\Contracts\ProductContract;
use App\Repositories\ProductRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        AttributeContract::class        =>          AttributeRepository::class,
        ProductContract::class          =>          ProductRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind($interface, $implementation);
        }
    }
}
