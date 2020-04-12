<?php
/**
 * Created by PhpStorm.
 * User: vash
 * Date: 22/03/20
 * Time: 7:03 AM
 */
namespace Vsynch\Contacts\Listeners;


use Vsynch\Contacts\Events\ContactRequested;

class HandleRequests
{
    public function handle(ContactRequested $event)
    {
        //$event->user,$event->requestingUser;
    }
}