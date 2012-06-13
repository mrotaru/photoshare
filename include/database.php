<?php
require_once("config.php");

class MySQLDatabase {
    
    // constants
    const DB_SERVER = 'localhost';
    const DB_USER = 'gallery';
    const DB_PASS = 'asdjkl';
    const DB_NAME = 'imgshare';

    // attributes
    //--------------------------------------------------------------------------
    private $connection;

    // constructors / destructors
    //--------------------------------------------------------------------------
    function __construct() {
        $this->open_connection();
    }

    // methods
    //--------------------------------------------------------------------------
    public function open_connection() {
        $this->connection = mysql_connect( $this::DB_SERVER, $this::DB_USER, $this::DB_PASS );
        if( !$this->connection ) {
            die( "Cannot connect to database: " . mysql_error());
        } else {
            $db_select = mysql_select_db( $this::DB_NAME, $this->connection );
            if( !$db_select ) {
                die( "Database selection failed: " . mysql_error() );
            }
        }
    }

    //--------------------------------------------------------------------------
    public function close_connection() {
        if( isset( $this->connection )) {
            mysql_close( $this->connection );
            unset( $this->connection );
        }
    }

    //--------------------------------------------------------------------------
    public function query( $sql ) {
        $result = mysql_query( $sql, $this->connection );
        $this->confirm_query( $result );
        return $result;
    }

    //--------------------------------------------------------------------------
    private function confirm_query( $result ) {
        if( !$result ) {
            die( "Database query failed: " . mysql_error() );
        }
    }

    // sanitize $string, to make it SQL-safe
    // ~from: Lynda.com - Essential PHP with MySQL, 13-06
    //--------------------------------------------------------------------------
    function mysql_prep( $string ) {
        $magic_quotes_active = get_magic_quotes_gpc();
        $new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0

        if( $new_enough_php ) { // PHP v4.3.0 or higher
            // undo any magic quote effects so mysql_real_escape_string can do the work
            if( $magic_quotes_active ) { 
                $string = stripslashes( $string ); 
            }
            $string = mysql_real_escape_string( $string );
        } else  { // before PHP v4.3.0
            // if magic quotes aren't already on then add slashes manually
            if( !$magic_quotes_active ) { 
                $string = addslashes( $string ); 
            }
            // if magic quotes are active, then the slashes already exist
        }
        return $string;
    }
}

$database = new MySQLDatabase();
?>
