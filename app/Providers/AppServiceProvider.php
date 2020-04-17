<?php

namespace App\Providers;

use App\Billing\BankPaymentGateway;
use Illuminate\Support\Facades\View;
use App\Billing\CreditPaymentGateway;
use Illuminate\Support\Facades\Schema;
use App\Billing\PaymentGatewayContract;
use Illuminate\Support\ServiceProvider;
use App\CustomFacades\PostcardSendingService;
use App\Http\View\Composers\ChannelsComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Any time someone wants a (or in this case 'the') PaymentGatewayContract
        // interface, they will recieve the BankPaymewntGateway implementation
        $this->app->singleton(PaymentGatewayContract::class, function ($app) {
            if (request()->has('credit')) {
            // "8000/pay?credit=true" would resolve to CreditPaymentGateway
                return new CreditPaymentGateway('euro');
            }
            
            return new BankPaymentGateway('usd');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        // can now be called as app()['Postcard']
        $this->app->singleton('Postcard', function($app) {
            // any time the PostcardSendingService class is resolved, this will be returned -->
            return new PostcardSendingService('US', 4, 6);  
        });

        
        // OPTION 1 -- every single view get $channels variable
        // View::share('channels', Channel::orderBy('name')->get());

        // OPTION 2 -- only posts.create and channel.index views get it
        // View::composer(['submission.create', 'channel.index'], function ($view) {
        //     $view->with('channels', Channel::orderBy('name', 'desc')->get());
        // });

        // OPTION 3 -- Dedicated Class
        // only gives $channels variable to the specific partials using it ✅ WOW !!!
        View::composer('partials.channels.*', ChannelsComposer::class);


    }
}
