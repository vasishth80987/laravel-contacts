# Laravel Contacts
Simple social networking module built for laravel. Includes friend requests and invitation based user registration.

## Installation
```
composer require vsynch/contacts
```

Publish package files
```
php artisan vendor:publish --provider="Vsynch\Contacts\ContactsServiceProvider"

```

## Usage
Add trait 'Contactable' to your user models.
```
class User extends Authenticatable
{
    use Contactable;
}
```
Add trait 'CheckInvitations' to your Register Controller.
```
class RegisterController extends Controller
{
    use RegistersUsers,CheckInvitations;
}
```
