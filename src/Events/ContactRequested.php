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

class ContactRequested
{
    use Dispatchable, SerializesModels;

    public $user;

    public $requestingUser;

    public function __construct(User $user,User $requestingUser)
    {
        $this->user = $user;
        $this->requestingUser = $requestingUser;
    }
}