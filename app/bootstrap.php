<?php
// LOAD CONFIG
require_once 'config/config.php';

//LOAD HELPERS
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';


// AUTOLOAD CORE LIBRARIES
// IL REQUIRE LES LIBRARIES NECESSAIRES AUTOMATIQUEMENT
spl_autoload_register(function ($className) {
    require_once 'libraries/' . $className . '.php';
});
