<?php
/**
 * Created by PhpStorm.
 * User: vash
 * Date: 24/03/20
 * Time: 5:37 PM
 */

Route::group(['prefix' => config('vsynch_contacts.api_route_url_prefix'), 'as' => config('vsynch_contacts.api_route_name_prefix'), 'namespace' => 'Vsynch\\Contacts\\Controllers', 'middleware' => config('vsynch_contacts.api_route_middleware')], function () {

    Route::get('/contacts/', 'ContactsApiController@getContacts')->name('contacts.index');
    Route::get('/contacts/{contact}/show', 'ContactsApiController@showContact')->name('contacts.show');
    Route::get('/contacts/requests/new', 'ContactsApiController@newContactRequestForm')->name('contacts.request.add');
    Route::post('/contacts/requests/new', 'ContactsApiController@newContactRequest')->name('contacts.request.store');
    Route::get('/contacts/requests/pending', 'ContactsApiController@pendingRequests')->name('contacts.request.pending');
    Route::get('/contacts/requests/{contactRequest}/accept', 'ContactsApiController@acceptRequest')->name('contacts.request.accept');
    Route::get('/contacts/requests/sent', 'ContactsApiController@sentRequests')->name('contacts.request.sent');
    Route::delete('/contacts/requests/{contactRequest}/remove', 'ContactsApiController@deleteRequest')->name('contacts.request.delete');
    Route::get('/contacts/requests/', 'ContactsApiController@pendingRequests')->name('contacts.request');
    Route::get('/contacts/invitations', 'ContactsApiController@invitations')->name('contacts.invite.index');
    Route::delete('/contacts/invitations/{invitation}/remove', 'ContactsApiController@deleteInvitation')->name('contacts.invite.remove');
    Route::delete('/contacts/{contact}/remove', 'ContactsApiController@removeContact')->name('contacts.remove');
});