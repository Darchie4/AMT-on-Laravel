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

    //Search and filtering
    'users_search_here'=>'Søg her...',
    'filter_instructors'=>'Undervisere',
    'filter_admins' =>'Administratorer',
    'filter_members'=>'Medlemmer',




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
    'lesson_create_difficulty' => 'Dygtigheds grad',
    'lesson_create_instructor' => 'Unservis(ere)',
];
