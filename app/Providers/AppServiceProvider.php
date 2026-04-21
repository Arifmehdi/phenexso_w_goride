<?php

namespace App\Providers;


use App\Models\Menu;
use App\Models\Page;
use App\Models\Cart;
use App\Models\WebsiteParameter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;

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
    public function boot()
    {
        // if (session()->has('locale')) {
        //     app()->setLocale(session('locale'));
        // }

        if (!function_exists('calculateDiscountPercentage')) {
            function calculateDiscountPercentage($originalPrice, $discountPrice) {
                if ($originalPrice <= 0) return 0;
                return round((($originalPrice - $discountPrice) / $originalPrice) * 100);
            }
        }

        // Share basic data with all views
        View::composer('*', function ($view) {
            View::share('headerMenus', Menu::whereActive(true)->where('type','header_menu')->orderBy('drag_id')->latest()->get());
            View::share('footerMenus', Menu::whereActive(true)->where('type','footer_menu')->orderBy('drag_id')->latest()->get());
            View::share('ws', WebsiteParameter::first());
            
            // Get current session id
            $sessionId = Session::getId();

            $cartItems = Cart::with('product') // assuming Cart has product relation
                ->where('session_id', $sessionId)
                ->when(auth()->check(), function($query) {
                    $query->orWhere('user_id', auth()->id());
                })
                ->get();

            $cartCount = $cartItems->sum('quantity');

            View::share('cartItems', $cartItems);
            View::share('cartCount', $cartCount);
        });

        // Share product categories only with specific views
        View::composer(['frontend.products', 'frontend.home', 'frontend.shop'], function ($view) {
            $productCategories = ProductCategory::where('active', true)
                ->withCount(['products' => function($query) {
                    $query->where('active', true);
                }])
                ->having('products_count', '>', 0)
                ->orderBy('name')
                ->get();
            
            $view->with('productCategories', $productCategories);
        });

        Paginator::useBootstrap();
    }
}
