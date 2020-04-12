<?php

namespace Vsynch\Contacts\Traits;


use App\User;
use Illuminate\Support\Facades\DB;
use Vsynch\Contacts\Model\Invitation;

trait CheckInvitations
{
    /**
     * Override Laravel Auth Register method
     *
     * @param UploadedFile $file
     * @param null $folder
     * @param string $disk
     * @return false|string
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        $this->checkInvitations($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    protected function checkInvitations(User $user){
        $invitations = Invitation::where('invitation_to_email',$user->email)->get();

        if($invitations->count()>0){
            foreach($invitations as $invitation){
                $requestedBy = User::findOrFail($invitation->user_id);

                $user->contacts()->syncWithoutDetaching([$requestedBy->id]);
                $requestedBy->contacts()->syncWithoutDetaching([$user->id]);

                $invitation->delete();

                event(new ContactAccepted($user,$requestedBy));
            }
        }
    }
}
