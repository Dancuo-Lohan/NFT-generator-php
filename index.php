<?php
ob_start();
session_set_cookie_params(0, "/", null, true, true);
session_start();

error_reporting(0);
require('./settings/getip.php');

if (isset($_CountryCode_) && $_CountryCode_ == "FR") {
    require('./settings/translation/fr.php');
    $_CountryCode_ = "fr";
    date_default_timezone_set('Europe/Paris');
    setlocale(LC_TIME, "fr_FR");
    ini_set('display_errors', 1);
} else {
    require('./settings/translation/en.php');
    $_CountryCode_ = "en";
    date_default_timezone_set('America/New_York');
    setlocale(LC_TIME, "en_EN");
    ini_set('display_errors', 1);
}

if (isset($_GET['page']) && $_GET['page'] == 'maintenance') {
    include('./settings/maintenance.php');
} else {
    include('./public/index.php');
}

ob_end_flush();