<?php
/**
 * Created by PhpStorm.
 * User: vash
 * Date: 22/03/20
 * Time: 5:35 AM
 */
namespace Vsynch\Contacts;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Vsynch\Contacts\Events\ContactRequested;
use Vsynch\Contacts\Listeners\UpdateRequests;

class ContactsEventServiceProvider extends ServiceProvider
{

    protected $listen = [[]];

    public function __construct(\Illuminate\Contracts\Foundation\Application $app)
    {
        parent::__construct($app);
        $this->listen = config('vsynch_contacts.event_listeners');
    }

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
