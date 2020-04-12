<?php

namespace Vsynch\Contacts;

use Illuminate\Support\ServiceProvider;
use Vsynch\Contacts\Model\Contact;
use Vsynch\Contacts\Model\Invitation;
use Vsynch\Contacts\Model\ContactRequest;

class ContactsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //include __DIR__.'/Routes.php';
        if ($this->app->runningInConsole()) {

            //migrations
            $this->publishes([
                __DIR__ . '/../database/' => database_path('migrations/')
            ], 'migrations');

            //config file
            $this->publishes([
                __DIR__.'/Config/config.php' => config_path('vsynch_contacts.php')
            ], 'vsynch-contacts');

            // views
            $this->loadViewsFrom(__DIR__.'/Resources/views', 'Contacts');
            $this->publishes([
                __DIR__.'/Views' => resource_path('views/vendor/vsynch/contacts'),
            ], 'vsynch-contacts');
        }

        $this->loadRoutesFrom(__DIR__.'/Routes/contacts.php');
        $this->loadRoutesFrom(__DIR__.'/Routes/api_contacts.php');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
        $this->mergeConfigFrom(__DIR__.'/Config/config.php', 'vsynch_contacts');

        $this->app->bind('invitation', function ($app) {
            return new Invitation();
        });

        $this->app->bind('contact', function ($app) {
            return new Contact();
        });

        $this->app->bind('contactRequest', function ($app) {
            return new ContactRequest();
        });

        $this->app->register(ContactsEventServiceProvider::class);
        /*$this->app->make('Vsynch\UserActivity\UserActivityController');
        $this->loadViewsFrom(__DIR__.'/views', 'UserActivity');
        $this->app->bind('crud', function($app) {
            return new Crud();
        });
        */
    }
}
