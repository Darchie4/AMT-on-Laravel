<?php
return [
  /*|--------------------------------------------------------------------------
    | Custom labels
    |--------------------------------------------------------------------------
    | These labels are used in views created by us (when locale is da)
    |
    */

    'public_index_tittle_welcome' => 'Hold tilmeldings oversigt',
    'public_index_pageDescriptionHTML' => 'Her kan du se alle hold du er tilmeldt og lidt praktisk information om holdene.<br>Du kan også klikke på hold navnet og se den fulde information om holdet',
    'public_index_pageDescription' => 'TEST',
    'public_index_tittle_currentRegistrations' => 'Dine nuværende tilmeldinger',
    'public_index_tittle_pastRegistrations' => 'Dine tideligere tilmeldinger',
    'public_index_lessonName' => 'Holdets navn',
    'public_index_fromDate' => 'Tilmeldt',
    'public_index_toDate' => 'Udmeldt',
    'public_index_time' => 'Træningstider',
    'public_index_price' => 'Pris',
    'public_index_functions' => '',



    'admin_lessonIndex_tittle_welcome' => 'Tilmeldings oversigt for :lessonName',
    'admin_lessonIndex_pageDescription' => 'Her kan du se alle aktive og inaktive tilmeldinger for :lessonName, samt generelle informationer om tilmeldingerne',
    'admin_lessonIndex_tittle_currentRegistrations' => 'Aktive tilmeldinger',
    'admin_lessonIndex_userName' => 'Navn',
    'admin_lessonIndex_userAge' => 'Alder',
    'admin_lessonIndex_userAddress' => 'Addresse',
    'admin_lessonIndex_fromDate' => 'Tilmeldt',
    'admin_lessonIndex_functions' => 'Administrations funktioner',
    'admin_lessonIndex_functions_cancelRegistration' => 'Udmeld',
    'admin_lessonIndex_functions_confirm_cancelRegistration' => 'Er du sikker på at du vil udmelde :userName?',
    'admin_lessonIndex_toDate' => 'Udmeldt',
    'admin_lessonIndex_tittle_pastRegistrations' => 'Udmeldte',
    'registration_index_noRegistrations' => 'Der er ingen tilmeldinger til dette hold',



    'admin_userIndex_tittle_welcome' => 'Tilmeldings oversigt for :fname :lname', # :fname = Users first name, :lname = Users last name
    'admin_userIndex_pageDescription' => 'Her kan du se en oversigt over hvilke hold :fname er tilmeldt til og eventuelt udmeldt fra', # :fname = Users first name, :lname = Users last name
    'admin_userIndex_tittle_currentRegistrations' => 'Aktive tilmeldinger',
    'admin_userIndex_lessonName' => 'Navn',
    'admin_userIndex_fromDate' => 'Tilmeldt',
    'admin_userIndex_price' => 'Pris',
    'admin_userIndex_functions' => 'Administrations funktioner',
    'admin_userIndex_functions_cancelRegistration' => 'Afmeld',
    'admin_userIndex_functions_confirm_cancelRegistration' => 'Er du sikker på at du vil udmelde :fname :lname fra :lessonName', # :fname = Users first name, :lname = Users last name, :lessonName = The lesson that the user is being removed from
    'admin_userIndex_tittle_pastRegistrations' => 'Tideligere tilmeldinger',
    'admin_userIndex_toDate' => 'Udmeldt',



    'public_signup_errors_hasToBeLoggedIn' => 'Du skal være logget ind for at kunne tilmelde dig et hold',
    'public_signup_errors_cannotSignUp' => 'Du kan ikke tilmelde dig :lessonName', # :lessonName = Name of lesson
    'public_signup_errors_alreadySignedUp' => 'Du er allerede tilmeldt :lessonName', # :lessonName = Name of lesson
    'public_signup_success' => 'Du er blevet meldt på :lessonName', # :lessonName = Name of lesson
    'admin_lessonIndex_functions_moveUser' => 'Flyt',
    '' => '',

    'admin_index_statistics_tittle' => 'Tilmeldingsstatestikker',
    'admin_index_statistics_signupActiveCount' => 'Antal aktive tildmeldinger',
    'admin_index_statistics_signupDeActiveCount' => 'Antal afmeldte',

    'admin_index_links' => 'Funktioner',
    'admin_index_inactivateAll' => 'Afmeld alle',
    'admin_index_moveAll' => 'Flyt alle',

    'admin_moveSingle_title' => 'Flyt medlem',
    'admin_moveMultiple_title' => 'Flyt medlemmer',
    'admin_moveMultiple_selectedUsers' => 'Valgte medlemmer',
    'admin_moveSingle_selectedUser' => 'Valgt medlem',
    'admin_moveMultiple_moveFrom' => 'Flyttes fra',
    'admin_moveSingle_moveFrom' => 'Flyttes fra',
    'admin_moveMultiple_confirmMove' => 'Flyt medlemmer',
    'admin_moveSingle_confirmMove' => 'Flyt medlem',
    'admin_move_newLesson' => 'Nyt hold',
    'admin_move_placeholder_newLesson' => 'Eg, Pardans, Sportsdans, osv.',
    'admin_moveMultiple_success' => 'Flyttede :count medlemmer fra :fromLessonName til :toLessonName', # :count = no. of users moved, :fromLessonName = Lesson user moved from, :toLessonName = Lesson users moved to


];
