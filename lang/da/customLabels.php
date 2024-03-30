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

    //Search and filtering
    'users_search_here'=>'Søg her...',
    'filter_instructors'=>'Undervisere',
    'filter_admins' =>'Administratorer',
    'filter_members'=>'Medlemmer',

    //Users
    'user_details' => 'Brugerdetailer',
    'user_joined'=>'Medlem siden',

    //Instructor index
    'instructor_index_instructors' => 'Undervisere',
    'instructor_index_lessons'=>'Hold',
    'instructors'=>'Undervisere',
    'instructor_details'=>'Underviserdetailjer',

    //Instructor edit
    'instructor_instructor'=>'Underviser',
    'instructor_edit_profile_img'=>'Profilbillede',
    'instructor_edit_short_description'=>'Kort beskrivelse',
    'instructor_edit_long_description'=>'Lang beskrivelse',
    'instructor_all_instructors'=>'Alle undervisere',

    //Instructor create/details
    'instructor_choose_user'=>'Vælg bruger',
    'instructor_profile_img'=>'Profilbillede',


    //With variables
    'welcome_message' => 'Velkommen, :name', //in view: {{ __('messages.welcome_message', ['name' => Auth::user()->name]) }}

    // Lesson create
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
    'lesson_create_select_instructor_placeholder' => 'Vælg undervisere',
    'lesson_create_difficulty' => 'Dygtigheds grad',
    'lesson_create_instructor' => 'Unservis(ere)',
    'lesson_create_dance_style_placeholder' => 'Ex. Pardans, Hip Hop osv...',
    'lesson_create_difficulty_placeholder' => 'Ex. Begynder, Let Øvet osv...',
    'lesson_create_button_add_timeslot' => 'Tilføj Træningstid',
    'lesson_create_totalSignupSpaces' => 'Maksimal antal tilmeldinger',
    'lesson_create_toggle_visible' => 'Synlig på hjemmeside: ',
    'lesson_create_toggle_signup' => 'Åben for tilmelding: ',
    'lesson_create_button_submit' => 'Opret hold',

    // Lesson Index lang
    'lesson_index_table_name' => 'Navn',
    'lesson_index_table_age_min' => 'Min. Alder',
    'lesson_index_table_age_max' => 'Maks. Alder',
    'lesson_index_table_instructors' => 'Undervisere',
    'lesson_index_table_danceStyle' => 'Stilart',
    'lesson_index_table_difficulty' => 'Dygtighedsgrad',
    'lesson_index_table_functions' => 'Funktioner',

    'lesson_index_welcome' => 'Hold administration',
    'lesson_index_create_new' => 'Opret nyt hold',
    'lesson_index_statistics_tittle' => 'Hold Statistikker',
    'lesson_index_statistics_lesson_count' => 'Antal hold',
    'lesson_index_button_delete' => 'Slet',
    'lesson_index_links' => 'Funktioner',

    // Lesson Create Errors
    'lesson_create_error_end_or_startime_reverse' => 'Slut tidspunkt skal være før start',
    'lesson_create_error_timeslot_overlap' => 'Det angivende tidsrum overlapper med andre tider',
    'lesson_create_error_sortingIndexInUse' => 'Dette sorting index er allerede i brug',
    'lesson_create_error_season_endBeforeStart' => 'Sæson slut skal være efter start',
    'lesson_create_error_season_startAfterEnd' => 'Sæson start skal være før slut',
    'lesson_create_error_age_minLargerThanMax' => 'Mindste alder skal være mindre end eller lig med højeste alder',
    'lesson_create_error_age_maxSmallerThanMin' => 'Højeste alder skal være større end eller lig med mindste alder',
    'lesson_create_error_valueCannotBeLesThanZero' => 'Denne værdi kan ikke være under 0',
    'lesson_index_lessons' => 'Hold'
];
