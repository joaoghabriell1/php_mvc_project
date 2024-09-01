<?php
// Load Config
require_once 'config/config.php';

//Load Helpers

require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';

// Autoload Core Libraries (for this to work the class inside the library file needs to have the same name of the file);

spl_autoload_register(function ($className) {
    require_once 'libraries/' . $className . '.php';
});
