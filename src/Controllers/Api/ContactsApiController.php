<?php
/**
 * Created by PhpStorm.
 * User: vash
 * Date: 24/03/20
 * Time: 5:25 PM
 */

namespace Vsynch\Contacts\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Mail;
use Vsynch\Contacts\Events\ContactAccepted;
use Vsynch\Contacts\Events\ContactInvited;
use Vsynch\Contacts\Events\ContactRequested;
use Vsynch\Contacts\Model\Contact;
use Vsynch\Contacts\Model\Invitation;
use Vsynch\Contacts\Model\ContactRequest as ContactRequest;
use Vsynch\Contacts\Mail\ContactRequested as MailRequest;
use Illuminate\Http\Request as Request;

class ContactsApiController extends Controller
{
    public function getContacts(Request $request)
    {
        if($request->has('per_page')) $perPage = $request->get('per_page');
        else $perPage = 5;

        if (!empty($keyword)) {
            $contacts = $request->user()->contacts()->where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $contacts = $request->user()->contacts()->latest()->paginate($perPage);
        }

        return response()->json(['success'=>true,'contacts'=>$contacts,'recordsTotal'=>$contacts->count(),'recordsFiltered'=>$contacts->count()],200);
    }

    public function newContactRequest(Request $request)
    {
        $input = $request->all();

        $user = User::where('email',$input['email'])->first();

        if($user){
            if($request->user()->contacts()->where('user2',$user->id)->first()) return response()->json(['success'=>false,'error'=>'This user is already in your contacts'],200);
            if($request->user()->contactRequests()->where('contact_user_id',$user->id)->first() || $request->user()->pendingContactRequests()->where('user_id',$user->id)->first()) return response()->json(['success'=>false,'error'=>'A request is already pending with this user.'],200);
            $request->user()->contactRequests()->syncWithoutDetaching([$user->id]);
            event(new ContactRequested($user,$request->user()));
        }
        else{
            Mail::to($input['email'])->send(new MailRequest($request->user(),$input['name']));
            if(!$request->user()->contactInvitations()->where('invitation_to_email',$input['email'])->first())
                Invitation::create(['user_id'=>$request->user()->id,'invitation_to_name'=>$input['name'],'invitation_to_email'=>$input['email']]);
            event(new ContactInvited($input,$request->user()));
        }

        return response()->json(['success'=>true,'message'=>'Contact Request/Invite has been Sent. An entry will be made to your list once they accept the request!'],200);
    }

    public function invitations(Request $request)
    {
        $invitations = Invitation::where('user_id',$request->user()->id)->paginate(25);

        return response()->json(['success'=>true,'invitations'=>$invitations,'recordsTotal'=>$invitations->count(),'recordsFiltered'=>$invitations->count()],200);
    }

    public function deleteInvitation(Invitation $invitation,Request $request)
    {
        if($request->user()->id == $invitation->user_id) $invitation->delete();
        else abort(403,'Forbidden! Invitation does not belong to user.');
        return response()->json(['success'=>true,'message'=>'Invitation removed!'],200);
    }

    public function pendingRequests(Request $request)
    {
        $user = $request->user();

        $requests = $user->pendingContactRequests()->paginate(25);

        return response()->json(['success'=>true,'requests'=>$requests,'recordsTotal'=>$requests->count(),'recordsFiltered'=>$requests->count()],200);
    }

    public function acceptRequest(ContactRequest $contactRequest, Request $request)
    {
        $user = $request->user();
        $requestedBy = User::findOrFail($contactRequest->user_id);

        if($contactRequest->contact_user_id==$user->id){
            $user->contacts()->syncWithoutDetaching([$contactRequest->user_id]);
            $requestedBy->contacts()->syncWithoutDetaching([$user->id]);
            $contactRequest->delete();
            event(new ContactAccepted($user,User::findOrFail($contactRequest->user_id)));
        }
        else abort(403,'Forbidden! Request does not match to user.');

        return response()->json(['success'=>true,'message'=>'Request accepted!'],200);
    }

    public function sentRequests(Request $request)
    {
        $user = $request->user();

        $requests = $user->contactRequests()->paginate(25);

        return response()->json(['success'=>true,'requests'=>$requests,'recordsTotal'=>$requests->count(),'recordsFiltered'=>$requests->count()],200);
    }

    public function deleteRequest(ContactRequest $contactRequest,Request $request)
    {
        if($request->user()->id == $contactRequest->user_id || $request->user()->id == $contactRequest->contact_user_id) $contactRequest->delete();
        else abort(403,'Forbidden! Request does not match to user.');
        return response()->json(['success'=>true,'message'=>'Request deleted!'],200);
    }

    public function showContact(Contact $contact, Request $request)
    {

        $contactUser = ($contact->user1==$request->user()->id)? User::findOrFail($contact->user2):(($contact->user2==$request->user()->id)?User::findOrFail($contact->user1):abort(403,'Forbidden! User not in your contact List.'));

        $contactUser->pivotId = $contact->id;
        return response()->json(['success'=>true,'contactUser' => $contactUser],200);
    }

    public function removeContact(Contact $contact,Request $request)
    {
        $user1 = $contact->user1;
        $user2 = $contact->user2;
        if($request->user()->id==$contact->user1||$request->user()->id==$contact->user2){
            $contact->delete();
            //Contact::where(['user1'=>$user2,'user2'=>$user1])->delete();
        }
        else abort(403,'Forbidden! User not in your contact List.');
        return response()->json(['success'=>true,'message'=>'Contact removed!'],200);
    }
}
