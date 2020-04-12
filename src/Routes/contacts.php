<?php
/**
 * Created by PhpStorm.
 * User: vash
 * Date: 21/03/20
 * Time: 7:36 AM
 */

Route::group(['prefix' => config('vsynch_contacts.route_url_prefix'), 'as' => config('vsynch_contacts.route_name_prefix'), 'namespace' => 'Vsynch\\Contacts\\Controllers', 'middleware' => config('vsynch_contacts.route_middleware')], function () {

    Route::get('/contacts/', 'ContactsController@getContacts')->name('contacts.index');
    Route::get('/contacts/{contact}/show', 'ContactsController@showContact')->name('contacts.show');
    Route::get('/contacts/requests/new', 'ContactsController@newContactRequestForm')->name('contacts.request.add');
    Route::post('/contacts/requests/new', 'ContactsController@newContactRequest')->name('contacts.request.store');
    Route::get('/contacts/requests/pending', 'ContactsController@pendingRequests')->name('contacts.request.pending');
    Route::get('/contacts/requests/{contactRequest}/accept', 'ContactsController@acceptRequest')->name('contacts.request.accept');
    Route::get('/contacts/requests/sent', 'ContactsController@sentRequests')->name('contacts.request.sent');
    Route::delete('/contacts/requests/{contactRequest}/remove', 'ContactsController@deleteRequest')->name('contacts.request.delete');
    Route::get('/contacts/requests/', 'ContactsController@pendingRequests')->name('contacts.request');
    Route::get('/contacts/invitations', 'ContactsController@invitations')->name('contacts.invite.index');
    Route::delete('/contacts/invitations/{invitation}/remove', 'ContactsController@deleteInvitation')->name('contacts.invite.remove');
    Route::delete('/contacts/{contact}/remove', 'ContactsController@removeContact')->name('contacts.remove');
});