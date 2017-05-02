<?php

namespace App\Providers;

use App\Matriushka;
use Blade;
use function foo\func;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('cache', function($expression) {
            return "<?php if (! App\Matriushka::setUp($expression)) { ?>";
            //return Matriushka::setUp($expression);
        });

        Blade::directive('endcache', function($expression) {
            return "<?php } echo App\Matriushka::tearDown() ?>";
            //return Matriushka::tearDown();
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
