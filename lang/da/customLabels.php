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
    'welcome_message' => 'Velkommen, :name' //in view: {{ __('messages.welcome_message', ['name' => Auth::user()->name]) }}
];
