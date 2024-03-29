<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

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
        if (Schema::hasTable('settings')) {
            if (!Config('settings')) {
                foreach (Setting::all()->pluck('value', 'key') as $k => $val) {
                    config(['settings.' . $k => $val]);
                }
            }
        }

        Builder::macro("search", function ($field, $search) {
            return $search ? $this->where($field, 'like', '%' . $search . '%') : $this;
        });

        Blade::directive('currency', function ($price) {
            return  "<?php echo Number::currency($price, 'PHP'); ?>";
        });

        Blade::directive('datetime', function ($expression) {
            return "<?php echo ($expression)->format('M d,Y'); ?>";
        });
    }
}
