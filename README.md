# user-activity-tracking
User tracking and Activity logging trait package for laravel

## Installation
```
composer require vsynch/activity-tracking
```

## Usage
Add trait 'Trackable' to your models.
```
class User extends Authenticatable
{
    use Trackable;
}
```
Now you can add activity messages to your classes in your user functions
```
$user = new User();

$user->save();

$user->activities()->create(['activity'=>'A new user has been created.');

```
Retrieve activity in your blades
```
@foreach($user->activities as $activity)
<p>{{$activity->activity}}</p>
@endforeach
```
