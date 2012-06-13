<?php

// what databases are available ?
// -----------------------------------------------------------------------------
function show_databases()
{
    $query = 'SHOW DATABASES';
    $dbs = mysql_query( "$query" );
    if( !$dbs )
    {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }
    else
    {
        echo( "<br/>" );
        echo( "Databases: " );
        echo( "<hr/>" );

        while( $db = mysql_fetch_array( $dbs ))
        {
            echo $db[0] . "<br/>";
        }
        echo( "<hr/>" );
    }
}

// die if query has not been executed successfully
// -----------------------------------------------------------------------------
function check_query( $result_set )
{
    if( !$result_set )
    {
        die( "Database query failed: " . mysql_error() );
    }
}

// test if all form variables have values assigned to them
// -----------------------------------------------------------------------------
function filled_out( $form_vars )
{
    foreach( $form_vars as $key => $value )
    {
        if( !isset( $key ) || ( $value == ''))
        {
            return false;
        }
    }
    return true;
}

// sanitize $string, to make it SQL-safe
// ~from: Lynda.com - Essential PHP with MySQL, 13-06
// -----------------------------------------------------------------------------
function mysql_prep( $string ) {
    $magic_quotes_active = get_magic_quotes_gpc();
    $new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0

    if( $new_enough_php ) // PHP v4.3.0 or higher
    {
        // undo any magic quote effects so mysql_real_escape_string can do the work
        if( $magic_quotes_active ) 
        { 
            $string = stripslashes( $string ); 
        }
        $string = mysql_real_escape_string( $string );
    } 
    else // before PHP v4.3.0
    {
        // if magic quotes aren't already on then add slashes manually
        if( !$magic_quotes_active ) 
        { 
            $string = addslashes( $string ); 
        }
        // if magic quotes are active, then the slashes already exist
    }
    return $string;
}

// from: PHP and MySQL Web Development 4th Edition, p.619
// -----------------------------------------------------------------------------
function valid_email( $email )
{
    if( @ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+.[a-zA-Z0-9\-\.]+$', $email ))
    {
        return true;
    }
    return false;
}
                
// -----------------------------------------------------------------------------
function show_all_users()
{
    echo( "All users in table 'users': </br>" );
    $result = mysql_query( "
        SELECT * FROM users WHERE 1" );
    check_query( $result );
    while( $user = mysql_fetch_array( $result ))
    {
        echo  $user[0] . "."
            . $user[1] . " "
            . $user[2] . " "
            . $user[3] . "<br/>";
    }
}

// uses headers
// ~from: Lynda.com - Essential PHP with MySQL
// -----------------------------------------------------------------------------
function redirect_to( $location = NULL )
{
    if( $location != NULL )
    {
        header("Location: {$location}");
        exit;
    }
}

// -----------------------------------------------------------------------------
function show_files_superglobal( $file_field_name )
{
    echo( "<pre>_FILES:<br/>" );
    foreach( $_FILES[ $file_field_name ] as $key => $value )
    {
        echo( "[ '" . $key . "' ] = " );
        echo( $value . "<br/>" );
    }
    echo( "</pre>" );
}

// -----------------------------------------------------------------------------
function show_post_superglobal()
{
    echo( "<pre>_POST:<br/>" );
    foreach( $_POST as $key => $value )
    {
        echo( "[ '" . $key . "' ] = " );
        echo( $value . "<br/>" );
    }
    echo( "</pre>" );
}

function show_get_superglobal()
{
    echo( "<pre>_GET:<br/>" );
    foreach( $_GET as $key => $value )
    {
        echo( "[ '" . $key . "' ] = " );
        echo( $value . "<br/>" );
    }
    echo( "</pre>" );
}

?>
