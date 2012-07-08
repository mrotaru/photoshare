<?php

// directory separator
defined( 'DS' ) ? null : define( 'DS', DIRECTORY_SEPARATOR );

// absolute path to project's folder
defined( 'SITE_ROOT' ) ? null :
    define( 'SITE_ROOT', 'e:' . DS . 'pdev' . DS . 'xampp' . DS . 'htdocs' . DS . 'imgshare' );

// path to 'include' folder
defined( 'LIB_PATH' ) ? null :
    define( 'LIB_PATH', SITE_ROOT . DS . 'include' );

require_once( LIB_PATH . DS . "config.php" );
require_once( LIB_PATH . DS . "functions.php" );
require_once( LIB_PATH . DS . "session.php" );

require_once( LIB_PATH . DS . "database.php" );
require_once( LIB_PATH . DS . "database_object.php" );
require_once( LIB_PATH . DS . "user.php" );
require_once( LIB_PATH . DS . "photograph.php" );
require_once( LIB_PATH . DS . "comment.php" );

?>
