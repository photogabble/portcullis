<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Home Route
    |--------------------------------------------------------------------------
    |
    | The path to the "home" route for your application. This is the default
    | location to where the user is redirected upon successful login.
    |
    | NOTE: From laravel 7 this can be set to RouteServiceProvider::HOME
    |
    */

    'home' => '/home',

    /*
    |--------------------------------------------------------------------------
    | Registration Open
    |--------------------------------------------------------------------------
    |
    | This value determines if your instance has open registration, you can
    | have closed registration but allow users to invite people. You can
    | also have closed registration with a waiting list.
    |
    */

    'open' => true,

    /*
    |--------------------------------------------------------------------------
    | Account Limit
    |--------------------------------------------------------------------------
    |
    | This value determines how many people can register to your instance
    | before registration becomes closed automatically. You should have a
    | reasonable limit set based upon the following metrics:
    |
    | - How many widgets your server can serve
    | - How much disk space you have available per widget, including backups
    | - How much facility you have for moderating your users, you should
    |   have at least one moderator per 100 users
    |
    */

    'limit' => 100,

    /*
    |--------------------------------------------------------------------------
    | User Invites
    |--------------------------------------------------------------------------
    |
    | This value determines whether your users can send invite links to their
    | friends. It has one of a few possible values:
    |
    | - 'INVITES_LIMITED': Once the user limit has been reached invites are
    |   no longer enabled, they are otherwise not affected by registration
    |   being open/closed
    | - 'OPEN_LIMITED': The invite mechanism is only enabled so long as
    |   registration is enabled
    | - 'ENABLED': All users can send invite links even if the instance is
    |   at or above the limit and registration is otherwise closed
    | - 'DISABLED': User invites functionality is disabled
    |
    */

    'invites' => 'DISABLED',

    /*
    |--------------------------------------------------------------------------
    | Queue
    |--------------------------------------------------------------------------
    |
    | This value determines whether people interested in joining during a
    | time when registration is closed can subscribe to a queue in order
    | to be one of the first people to get an account when registration
    | is enabled in the future.
    |
    */

    'queue' => true,

    /*
    |--------------------------------------------------------------------------
    | Registration Validator
    |--------------------------------------------------------------------------
    |
    | This value is used to validate a users registration details.
    |
    */
    'validation' => [
        'display_name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:255', 'unique:users'],
        'email' => ['nullable', 'string', 'email', 'max:255'],
        'password' => ['required', 'string', 'min:8'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Registration Attributes
    |--------------------------------------------------------------------------
    |
    | This closure should map the input $data array to what your application
    | needs to be saved when a new user is registered.
    |
    */
    'attributes' => function (array $data) {
        return [
            'display_name' => $data['display_name'],
            'email' => $data['email'] ?? null,
            'username' => $data['username'],
            'password' => Illuminate\Support\Facades\Hash::make($data['password']),
        ];
    }

];
