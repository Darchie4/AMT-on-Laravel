<?php

return [
    /*|--------------------------------------------------------------------------
      | Custom labels
      |--------------------------------------------------------------------------
      | These labels are used in views created by us (when locale is da)
      |
      */

    // Lesson create
    'admin_create_title' => 'Opret hold',
    'admin_create_button_showAll' => 'Vis alle hold',

    'admin_create_Name' => 'Lektionens navn',
    'admin_create_shortDescription' => 'Kort beskrivelse',
    'admin_create_LongDescription' => 'Lang beskrivelse',
    'admin_create_seasonStart' => 'Sæsonens start',
    'admin_create_seasonEnd' => 'Sæsonens slutningen',
    'admin_create_ageMin' => 'Minimums alder',
    'admin_create_ageMax' => 'Maksimum alder',
    'admin_create_price' => 'Pris',
    'admin_create_title_timeAndLocation' => 'Lokale bookning',
    'admin_create_startTime' => 'Start tidspunkt',
    'admin_create_endTime' => 'Slut tidspunkt',
    'admin_create_weekDay_title' => 'Ugedag',
    'admin_create_weekDay_monday' => 'Mandag',
    'admin_create_weekDay_tuesday' => 'Tirsdag',
    'admin_create_weekDay_wednesday' => 'Onsdag',
    'admin_create_weekDay_thursday' => 'Torsdag',
    'admin_create_weekDay_friday' => 'Fredag',
    'admin_create_weekDay_saturday' => 'Lørdag',
    'admin_create_weekDay_sunday' => 'Søndag',
    'admin_create_location' => 'Lokation',
    'admin_create_button_addTimeslot' => 'Tilføj timeslot',
    'admin_create_coverImage' => 'Dæk billede',
    'admin_create_danceStyle' => 'Stilart',
    'admin_create_placeholder_selectInstructor' => 'Vælg undervisere',
    'admin_create_difficulty' => 'Dygtigheds grad',
    'admin_create_instructor' => 'Unservis(ere)',
    'admin_create_placeholder_danceStyle' => 'Ex. Pardans, Hip Hop osv...',
    'admin_create_placeholder_difficulty' => 'Ex. Begynder, Let Øvet osv...',
    'admin_create_button_add_timeslot' => 'Tilføj Træningstid',
    'admin_create_totalSignupSpaces' => 'Maksimal antal tilmeldinger',
    'admin_create_toggle_visible' => 'Synlig på hjemmeside: ',
    'admin_create_toggle_signup' => 'Åben for tilmelding: ',
    'admin_create_button_submit' => 'Opret hold',

    'admin_edit_button_submit' => 'Rediger hold',


    // Lesson Index lang
    'admin_index_table_name' => 'Navn',
    'admin_index_table_age_min' => 'Min. Alder',
    'admin_index_table_age_max' => 'Maks. Alder',
    'admin_index_table_instructors' => 'Undervisere',
    'admin_index_table_danceStyle' => 'Stilart',
    'admin_index_table_difficulty' => 'Dygtighedsgrad',
    'admin_index_table_signups' => 'Tilmeldte',
    'admin_index_table_functions' => 'Funktioner',

    'admin_index_welcome' => 'Hold administration',
    'admin_index_create_new' => 'Opret nyt hold',
    'admin_index_statistics_tittle' => 'Hold statestikker',
    'admin_index_statistics_lessonCount' => 'Antal hold',
    'admin_index_statistics_totalActiveRegistrations' => 'Antal aktive tilmeldinger',
    'admin_index_statistics_totalSpaces' => 'Antal ledige pladser',
    'admin_index_statistics_totalFilledLessons' => 'Antal fyldte hold',
    'admin_index_statistics_totalAlmostFilledLessons' => 'Antal hold med 2 eller færre ledige pladser',
    'admin_index_button_delete' => 'Slet',
    'admin_index_button_confirmDelete' => 'Er du sikker på at du vil slette :lessonName',
    'admin_index_button_edit' => 'Rediger',
    'admin_index_links' => 'Funktioner',

    // Lesson show
    'admin_show_title_practicalInformation' => 'Praktisk information',
    'admin_show_danseStyle' => 'Stilart:',
    'admin_show_difficulty' => 'Dygtigheds grad:',
    'admin_show_ageGroup' => 'Alders gruppe:',
    'admin_show_price' => 'Pris:',
    'admin_show_seasonStart' => 'Sæson start:',
    'admin_show_seasonEnd' => 'Sæson slut:',
    'admin_show_trainingTimes' => 'Trænings tider',
    'admin_show_teachers' => 'Trænere',
    'admin_show_description' => 'Beskrivelse',
    'admin_show_' => '',
    'admin_show_' => '',
    '' => '',

    // Lesson Create Errors
    'admin_create_error_end_or_startime_reverse' => 'Slut tidspunkt skal være før start',
    'admin_create_error_timeslot_overlap' => 'Det angivende tidsrum overlapper med andre tider',
    'admin_create_error_sortingIndexInUse' => 'Dette sorting index er allerede i brug',
    'admin_create_error_season_endBeforeStart' => 'Sæson slut skal være efter start',
    'admin_create_error_season_startAfterEnd' => 'Sæson start skal være før slut',
    'admin_create_error_age_minLargerThanMax' => 'Mindste alder skal være mindre end eller lig med højeste alder',
    'admin_create_error_age_maxSmallerThanMin' => 'Højeste alder skal være større end eller lig med mindste alder',
    'admin_create_error_valueCannotBeLesThanZero' => 'Denne værdi kan ikke være under 0',

    'admin_edit_title' => 'Rediger hold',

    '' => '',
    'public_index_welcomeTittle' => 'Hold oversigt',
    'public_index_welcomeDescription' => 'Her hos $assosiation har vi mange spændende hold man kan melde sig på!<br>Her kan du se en liste over dem alle sammen og forhåbenligt en dag også søge i dem',
    'public_index_tittleGeneralInformation' => 'Praktisk information',
    'public_index_ageSpan' => 'Alder: ',
    'public_index_danceStyle' => 'Stilart: ',
    'public_index_difficulty' => 'Digtighedsgrad: ',
    'public_index_price' => 'Pris: ',
    'public_index_seasonStart' => 'Sæson start: ',
    'public_index_seasonEnd' => 'Sæson slut: ',
    'public_index_currency' => 'DKK.',
    'public_index_imgAltText' => 'Her skulle have været et billede af: ',
    'public_index_shortDescription' => 'Beskrivelse',
    'public_index_teacherPlural' => 'Undervisere',
    'public_index_teacherSingle' => 'Underviser',
    'public_index_trainingTimes' => 'Træningstider',
    'public_index_showInformation' => 'Se mere',
    'public_index_signup' => 'Tilmeld',
    'public_index_location' => 'Lokation: ',
    'public_index_weekDay' => 'Ugedag:',
    'public_index_timeStart' => 'Starttidspunkt',
    'public_index_timeEnd' => 'Sluttidspunkt',


    'public_signup_errors_cannotSignUp' => 'Det er desværre ikke muligt at tilmelde sig dette hold',
    'public_signup_public_signup_confirm' => 'Tilmeld',
    'public_signup_public_signup_goBack' => 'Gå tilbage',
    'public_signup_public_signup_welcome' => 'Tilmedling',
    'public_signup_public_signup_nameOfLesson' => 'Du er ved at tilmelde dig til: ',
    'public_signup_public_signup_' => '',
    'public_signup_public_signup_' => '',
    'public_signup_public_signup_' => '',
    'public_signup_public_signup_' => '',
    '' => '',
    '' => '',


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


    // Lesson Create Errors
    'lesson_create_error_end_or_startime_reverse' => 'Slut tidspunkt skal være før start',
    'lesson_create_error_timeslot_overlap' => 'Det angivende tidsrum overlapper med andre tider',
    'lesson_create_error_sortingIndexInUse' => 'Dette sorting index er allerede i brug',
    'lesson_create_error_season_endBeforeStart' => 'Sæson slut skal være efter start',
    'lesson_create_error_season_startAfterEnd' => 'Sæson start skal være før slut',
    'lesson_create_error_age_minLargerThanMax' => 'Mindste alder skal være mindre end eller lig med højeste alder',
    'lesson_create_error_age_maxSmallerThanMin' => 'Højeste alder skal være større end eller lig med mindste alder',
    'lesson_create_error_valueCannotBeLesThanZero' => 'Denne værdi kan ikke være under 0',
    'admin_index_lessons' => 'Hold',


    // Lesson Create Links
    'admin_create_link_instructor' => 'Mangler underviser?',
    'admin_create_link_priceStructure' => 'Mangler prisstruktur?',
    'admin_create_link_location' => 'Mangler lokation?',

];
