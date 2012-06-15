<?php

// die if query has not been executed successfully
// -----------------------------------------------------------------------------
function check_query( $result_set ) {
    if( !$result_set ) {
        die( "Database query failed: " . mysql_error() );
    }
}

// from: PHP and MySQL Web Development 4th Edition, p.619
// -----------------------------------------------------------------------------
function valid_email( $email )
{
    if( @ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+.[a-zA-Z0-9\-\.]+$', $email )) {
        return true;
    }
    return false;
}
                
// uses headers
// ~from: Lynda.com - Essential PHP with MySQL
// -----------------------------------------------------------------------------
function redirect_to( $location = NULL ) {
    if( $location != NULL ) {
        header("Location: {$location}");
        exit;
    }
}

// -----------------------------------------------------------------------------
function autoloader( $class_name ) {
    $class_name = strtolower( $class_name );

    // list of folders where to look for $class_name.php
    $folders = array( LIB_PATH . DS );
    
    $found = false;
    $path = "";
    foreach( $folders as $folder ) {
        $path = "{$folder}/{$class_name}.php";
        if( file_exists( $path ) ) {
            $found = true;
            break;
        }
    }

    if( $found ) {
        require_once( $path );
    } else {
        die( "The file {$class_name}.php could not be found." );
    }
}
spl_autoload_register( 'autoloader' );

// -----------------------------------------------------------------------------
function info_message( $message ) {
    if( !empty( $message ))
        echo "<p class=\"info_message\">{$message}</p>";
}

// -----------------------------------------------------------------------------
function error_message( $message ) {
    if( !empty( $message ))
        echo "<p class=\"error\">{$message}</p>";
}

// -----------------------------------------------------------------------------
function include_layout_template( $template="" ) {
    include( SITE_ROOT . DS . 'public' . DS . 'layouts' . DS . $template );
}

?>
