# user-activity-tracking
User tracking and Activity logging trait package for laravel

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
