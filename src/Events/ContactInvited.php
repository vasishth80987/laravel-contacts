<?php
/**
 * Created by PhpStorm.
 * User: vash
 * Date: 22/03/20
 * Time: 5:38 AM
 */
namespace Vsynch\Contacts\Events;

use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class ContactInvited
{
    use Dispatchable, SerializesModels;

    public $invited;

    public $requestingUser;

    public function __construct($invited,User $requestingUser)
    {
        $this->invited = $invited;
        $this->requestingUser = $requestingUser;
    }
}