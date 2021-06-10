<?php
/*--------------------------------------------------------------------------
 Define Application Configuration Constants
--------------------------------------------------------------------------*/
    define('BASE_DIR', str_replace("\\", "/", dirname(dirname(__DIR__))));
    define('APP',  BASE_DIR . "/app/");
    define('DOC_ROOT', BASE_DIR . "/public_html/");
    define('IMAGES',   DOC_ROOT . "/images/");
    define('STYLES',   DOC_ROOT . "/styles/");
    define('UPLOADS',  DOC_ROOT. "/client_uploads/");

    /*********************************************************************
    * Encryption Keys
    **********************************************************************/
    define('ENCRYPTION_KEY', "f@!$251Êìcef08%&3¥‹a0e");
    define('HMAC_SALT', "0%8Qfd9K4m6d$8a8C7n7^Ed6Dab");
    define('HASH_KEY', "9Mp7Lf2cHz5F");

    /*********************************************************************
    * style settings defaullts
    **********************************************************************/
    define('STYLE_DEFAULTS', array(
        'card_border_colour'        => '#545380',
        'card_header_colour'        => '#242359',
        'card_header_background'    => '#b4c3dc',
        'card_header_border_colour' => '#545380',
        'fsg_button_colour'         => '#4183c2',
        'fsg_button_colour_hover'   => '#242359',
        'page_title_colour'         => '#242359',
        'site_title_colour'         => '#fbfbfb',
        'quicklinks_header_colour'  => '#17142c',
        'top_banner_background'     => 'linear-gradient(161deg, rgba(138,105,140,1) 0%, rgba(36,35,89,1) 25%, rgba(23,20,44,1) 40%, rgba(23,20,44,1) 70%, rgba(65,131,194,1) 90%, rgba(130,165,208,1) 100%)'
    ));

/*************************************************************************
* Is Site Live?
**************************************************************************/
define('SITE_LIVE', false);
/*************************************************************************
* Under Maintenance?
**************************************************************************/
define('MAINTENANCE', false);
/*************************************************************************
* Some useful constants
**************************************************************************/
    //Direct Freight Fuel Surcharge
    define('DF_FUEL_SURCHARGE', 1.133);
/*************************************************************************
* Database Configuration
**************************************************************************/
define('DB_HOST', "localhost");
define('DB_NAME', "fsg_wms_dev");
define('DB_USER', "website");
define('DB_PASS', "66ihu#9J");
define('DB_CHARSET', "utf8");
?>
