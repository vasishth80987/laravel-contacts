<?php
/**
 * Created by PhpStorm.
 * User: vash
 * Date: 22/03/20
 * Time: 7:03 AM
 */
namespace Vsynch\Contacts\Listeners;


use Vsynch\Contacts\Events\ContactAccepted;

class HandleAccepts
{
    public function handle(ContactAccepted $event)
    {
        //$event->acceptedByUser,$event->addedByUser;
    }
}