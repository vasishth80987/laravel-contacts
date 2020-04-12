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

class ContactAccepted
{
    use Dispatchable, SerializesModels;

    public $acceptedByUser;

    public $addedByUser;

    public function __construct(User $acceptedByUser,User $addedByUser)
    {
        $this->acceptedByUser = $acceptedByUser;
        $this->addedByUser = $addedByUser;
    }
}