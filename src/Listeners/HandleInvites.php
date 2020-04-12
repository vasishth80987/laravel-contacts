<?php
/**
 * Created by PhpStorm.
 * User: vash
 * Date: 22/03/20
 * Time: 9:21 AM
 */
namespace Vsynch\Contacts\Listeners;


use Vsynch\Contacts\Events\ContactInvited;

class HandleInvites
{
    public function handle(ContactInvited $event)
    {
        //$event->invited,$event->requestingUser;
    }
}