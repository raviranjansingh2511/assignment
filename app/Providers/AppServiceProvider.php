<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;

use App\Models\City;

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
    public function boot(Request $request)
    {
        if (Schema::hasTable('settings')) {   // ✅ Prevent crash during migration
            $setting = Setting::first();
            $data = [
                'setting' => $setting
            ];
        } else {
            $data = [];
        }
        View::share($data);
    }
}