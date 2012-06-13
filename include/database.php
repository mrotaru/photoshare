<?php
require_once("config.php");

class MySQLDatabase {

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
        $this->connection = mysql_connect( DB_SERVER, DB_USER, DB_PASS );
        if( !$this->connection ) {
            die( "Cannot connect to database: " . mysql_error());
        } else {
            $db_select = mysql_select_db( DB_NAME, $this->connection );
            if( !$db_select ) {
                die) "Database selection failed: " . mysql_error() );
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
}

$database = new MySQLDatabase();
$
?>
