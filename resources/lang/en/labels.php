<?php

return [
  //With variables
    'welcome_message' => 'Welcome, :name', //in view: {{ __('messages.welcome_message', ['name' => Auth::user()->name]) }}
    'navbar_label_3' => 'Services',
];
