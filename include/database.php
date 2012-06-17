<?php

class MySQLDatabase {

    // constants
    const DB_SERVER = 'localhost';
    const DB_USER = 'imgshare';
    const DB_PASS = 'asdjkl';
    const DB_NAME = 'imgshare';

    // attributes
    private $connection;
    private $magic_quotes_active;
    private $real_escape_string_exists;
    public $last_query;

    // constructors / destructors
    //--------------------------------------------------------------------------
    function __construct() {
        $this->open_connection();
        $this->magic_quotes_active = get_magic_quotes_gpc();
        $this->real_escape_string_exists = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
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
        $this->last_query = $sql;
        $result = mysql_query( $sql, $this->connection );
        $this->confirm_query( $result );
        return $result;
    }

    //--------------------------------------------------------------------------
    private function confirm_query( $result ) {
        if( !$result ) {
            $output = "<div class=\"error\">Database query failed.<br/>Message: <span class=\"mysql_error\">" . mysql_error() . "</span><br/>";
            $output .="Query: <code>" . $this->last_query . "</code></div>";
            die( $output );
        }
    }

    // sanitize $string, to make it safe for database engines
    //--------------------------------------------------------------------------
    function escape_value( $string ) {
        if( $this->real_escape_string_exists ) { // PHP v4.3.0 or higher
            // undo any magic quote effects so mysql_real_escape_string can do the work
            if( $this->magic_quotes_active ) { $string = stripslashes( $string ); }
            $string = mysql_real_escape_string( $string );
        } else  { // before PHP v4.3.0
            // if magic quotes aren't already on then add slashes manually
            if( !$this->magic_quotes_active ) { 
                $string = addslashes( $string ); 
            }
            // if magic quotes are active, then the slashes already exist
        }
        return $string;
    }

    //--------------------------------------------------------------------------
    function fetch_array( $result_set ) {
        return mysql_fetch_array( $result_set);
    }

    //--------------------------------------------------------------------------
    public function num_rows($result_set) {
        return mysql_num_rows($result_set);
    }

    //--------------------------------------------------------------------------
    public function insert_id() {
        // get the last id inserted over the current db connection
        return mysql_insert_id($this->connection);
    }

    //--------------------------------------------------------------------------
    public function affected_rows() {
        return mysql_affected_rows($this->connection);
    }
}

$database = new MySQLDatabase();
?>
