<?php
/**
 * Created by PhpStorm.
 * User: vash
 * Date: 22/03/20
 * Time: 7:03 AM
 */
namespace App\Listeners;


use Vsynch\Contacts\Events\ContactRequested;

class HandleRequests
{
    public function handle(ContactRequested $event)
    {
        //$event->user,$event->requestingUser;
    }
}