<?php
/**
 * Created by PhpStorm.
 * User: vash
 * Date: 21/03/20
 * Time: 7:39 AM
 */
return [
    'name' => 'Vsynch\Contacts',
    'view_name' => 'Contact',
    'user_class' => 'App\\User',
    'route_middleware' => ['web','auth','verified'],
    'route_url_prefix' => 'admin',
    'route_name_prefix' => 'admin.',
    'api_route_middleware' => ['api','verifyApiToken','auth:api'],
    'api_route_url_prefix' => 'api/v1/',
    'api_route_name_prefix' => 'api.v1.',
    'event_listeners' => [
        \Vsynch\Contacts\Events\ContactRequested::class => [
            \Vsynch\Contacts\Listeners\HandleRequests::class,
        ],
        \Vsynch\Contacts\Events\ContactInvited::class => [
            \Vsynch\Contacts\Listeners\HandleInvites::class,
        ],
        \Vsynch\Contacts\Events\ContactAccepted::class => [
            \Vsynch\Contacts\Listeners\HandleAccepts::class,
        ]
    ]
];