<?php

namespace App\Providers;

use App\Contracts\CalculableInterface;
use App\Models\Calculator;
use App\Models\EmojiCalculator;
use App\Services\CalculationService;
use Illuminate\Support\ServiceProvider;

/**
 * Class CalculatorServiceProvider
 *
 * @package App\Providers
 */
class CalculatorServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CalculableInterface::class, CalculationService::class);
        $this->app->bind(Calculator::class, EmojiCalculator::class);

//        $this->app->extend(Calculator::class, function(){
//            return new EmojiCalculator();
//        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
