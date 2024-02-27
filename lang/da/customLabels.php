<?php

return [
  /*|--------------------------------------------------------------------------
    | Custom labels
    |--------------------------------------------------------------------------
    | These labels are used in views created by us (when locale is da)
    |
    */
    //Standard
    'Welcome' => 'Velkommen til!',

    //With variables
    'welcome_message' => 'Velkommen, :name' //in view: {{ __('messages.welcome_message', ['name' => Auth::user()->name]) }}
];
