<?php

return [
  /*|--------------------------------------------------------------------------
    | Custom labels
    |--------------------------------------------------------------------------
    | These labels are used in views created by us (when locale is en)
    |
    */
    //Standard
    'Welcome' => 'welcome to the app',
    'firstname' => 'First name',
    'Register' => 'Register account',
    'lastname' => 'Last name',


    //With variables
    'welcome_message' => 'Welcome, :name' //in view: {{ __('messages.welcome_message', ['name' => Auth::user()->name]) }}
];
