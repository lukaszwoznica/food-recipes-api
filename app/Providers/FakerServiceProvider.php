<?php

namespace App\Providers;

use Faker\{Factory, Generator};
use FakerRestaurant\Provider\en_US\Restaurant as RestaurantProvider;
use Gbuckingham89\FakerFood\en_GB\FoodProvider;
use Illuminate\Support\ServiceProvider;

class FakerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Generator::class, function () {
            $faker = Factory::create();
            $faker->addProvider(new FoodProvider($faker));
            $faker->addProvider(new RestaurantProvider($faker));

            return $faker;
        });
    }
}
