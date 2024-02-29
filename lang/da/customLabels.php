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
    'welcome_message' => 'Velkommen, :name', //in view: {{ __('messages.welcome_message', ['name' => Auth::user()->name]) }}

    'Fuckoff' => 'TEST TEXT',

    'lesson_create_Name' => 'Lektionens navn',
    'lesson_create_ShortDescription' => 'Kort beskrivelse',
    'lesson_create_LongDescription' => 'Lang beskrivelse',
    'lesson_create_seasonStart' => 'Sæsonens start',
    'lesson_create_seasonEnd' => 'Sæsonens slutningen',
    'lesson_create_ageMin' => 'Minimums alder',
    'lesson_create_ageMax' => 'Maksimum alder',
    'lesson_create_Price' => 'Pris',
    'lesson_create_coverImage' => 'Dæk billede',
    'lesson_create_danceStyle' => 'Stilart',
    'lesson_create_difficulty' => 'Digtigheds grad',
];
