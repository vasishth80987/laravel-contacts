# user-activity-tracking
Simple social networking module built for laravel. Include friend requests and invitation based user registration.

## Installation
```
composer require vsynch/laravel-contacts
```

Publish package files
```
php artisan vendor:publish --provider="Vsynch\Contacts\ContactsServiceProvider"

```

## Usage
Add trait 'Contactable' to your models.
```
class User extends Authenticatable
{
    use Contactable;
}
```
