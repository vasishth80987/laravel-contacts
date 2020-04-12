<?php
/**
 * Created by PhpStorm.
 * User: vash
 * Date: 22/03/20
 * Time: 2:42 AM
 */
namespace Vsynch\Contacts\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_contact_requests';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['contact_user_id', 'user_id'];

    public function requestBy(){
        return User::findOrFail($this->user_id);
    }
    public function requestedContact(){
        return User::findOrFail($this->contact_user_id);
    }
}