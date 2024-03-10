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
    'back' => 'Tilbage',
    'confirm' => 'Bekræft',

    //Register/login
    'Register' => 'Opret profil',
    'firstname' => 'Fornavn',
    'lastname' => 'Efternavn',
    'email' => 'Email',
    'phone' => 'Telefonnummer',
    'birthday' => 'Fødselsdag',
    'gender' => 'Køn',
    'choose' => 'Vælg...',
    'password' => 'Adgangskode',
    'password-confirm' => 'Bekræft adgangskode',
    'existing-user' => 'Har du allerede en bruger?',
    'login-here' => 'Log ind her',
    'login' => 'Log ind',
    'remember-me' => 'Husk mig',
    'forgot-password' => 'Har du glemt din adgangskode?',
    'users' => 'Brugere',
    'all_users' => 'Alle brugere',

    //Change to match genders in table Gender
    'male' => 'Mand',
    'female' => 'Kvinde',
    'other' => 'Andet',

    //Roles and permissions
    'role_name' => 'Rollenavn',
    'manage' => 'Administrer',
    'roles' => 'Roller',
    'permissions' => 'Tilladelser',
    'see_permissions'=>'Se tilladelser',
    'permission_name' => 'Tilladelsesnavn',
    'assign'=>'Tildel',

    //CRUD
    'edit' => 'Rediger',
    'delete' => 'Slet',
    'create' => 'Lav ny',

    //Admin
    'admin_settings' => 'Administrator indstillinger',

    //Users
    'user_details' => 'Brugerdetailer',
    'user_joined'=>'Medlem siden',





    //With variables
    'welcome_message' => 'Velkommen, :name', //in view: {{ __('messages.welcome_message', ['name' => Auth::user()->name]) }}


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
    'lesson_create_difficulty' => 'Dygtigheds grad',

    // Index lang
    'lesson_index_welcome' => 'Hold administration',
    'lesson_index_statistics_tittle' => 'Statistikker',
    'lesson_index_statistics_lesson_count' => 'Antal hold',
    'lesson_index_links' => 'Links',
    'lesson_index_create_new' => 'Opret nyt hold',

    'lesson_index_table_name' => 'Navn',
    'lesson_index_table_age_min' => 'Min. alder',
    'lesson_index_table_age_max' => 'Maks. alder',
    'lesson_index_table_instructors' => 'Unservis(ere)',
    'lesson_index_table_danceStyle' => 'Stilart',
    'lesson_index_table_difficulty' => 'Dygtighedsgrad',
    'lesson_index_table_functions' => 'funktioner',
];
