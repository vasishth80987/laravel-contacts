<?php
/**
 * Created by PhpStorm.
 * User: vash
 * Date: 21/03/20
 * Time: 7:27 AM
 */

namespace Vsynch\Contacts\Traits;

trait Contactable
{
    public function contacts()
    {
        return $this->belongsToMany('App\User', 'user_contacts', 'user1', 'user2')->wherePivot('blocked', 0)->withPivot('id as pivotId');
    }

    public function acceptedContacts()
    {
        return $this->belongsToMany('App\User', 'user_contacts', 'user2', 'user1')->wherePivot('blocked', 0)->withPivot('id as pivotId');
    }

    public function blockedContacts()
    {
        return $this->belongsToMany('App\User', 'user_contacts', 'user1', 'user2')->wherePivot('blocked', $this->id)->withPivot('id as pivotId');
    }
    
    public function contactRequests(){
        return $this->belongsToMany('App\User', 'user_contact_requests', 'user_id', 'contact_user_id')->withPivot('id as pivotId');
    }

    public function pendingContactRequests(){
        return $this->belongsToMany('App\User','user_contact_requests','contact_user_id','user_id')->withPivot('id as pivotId');
    }

    public function contactInvitations(){
        return $this->hasMany('Vsynch\Contacts\Model\Invitation','user_id');
    }
}
