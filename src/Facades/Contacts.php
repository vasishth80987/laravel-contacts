<?php
/**
 * Created by PhpStorm.
 * User: vash
 * Date: 21/03/20
 * Time: 3:36 AM
 */
namespace Vsynch\ActicityTracking\Facades;

use Illuminate\Support\Facades\Facade;

class Contacts extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'userContacts';
    }
}