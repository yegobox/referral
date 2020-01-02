<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Referral Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default Referral "strategy" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */
    'tablename'=>'users',
    'default_strategy'=>'cash',
    'registration_end_point'=>'register',
    'strategies' => [
        'points' => [
            'earn' => '10'
        ],

        'cash' => [
            'earn' => '200'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All Referral drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra Referral guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    //provide a model to use with a full namespace example User Model is given with expectation of App namespace
    'model' => App\User::class




];
