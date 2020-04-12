<?php
/**
 * Created by PhpStorm.
 * User: vash
 * Date: 22/03/20
 * Time: 7:03 AM
 */
namespace App\Listeners;


use App\Contract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Vsynch\Contacts\Events\ContactAccepted;
use Vsynch\Contacts\Mail\ContactRequested;

class HandleAccepts
{
    public function handle(ContactAccepted $event)
    {
        //$event->acceptedByUser,$event->addedByUser;
        $invitations = DB::table('contract_user_invitations')->where('contact_user_email',$event->acceptedByUser->email)->get();

        foreach($invitations as $invitation){
            $event->acceptedByUser->contractedToContracts()->save(new Contract($invitation->contract_id));
            DB::table('contract_user_invitations')->where('id',$invitation->id)->delete();
        }

    }
}