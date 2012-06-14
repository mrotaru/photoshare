<?php
require_once( "init.php" );
require_once( LIB_PATH . DS . "database.php" );

class User extends DatabaseObject {

    // attributes
    protected static $table_name = "users";
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $email;

    // concatenates the current object's first_name and last_name
    //--------------------------------------------------------------------------
    public function full_name() {
        if( isset( $this->first_name) && isset( $this->last_name ) ) {
            return $this->first_name . " " . $this->last_name;
        } else {
            return "";
        }
    }

    // checks the database if the supplied login details are valid, and if so,
    // returns the corresponding User object
    //--------------------------------------------------------------------------
    public static function authenticate( $username="", $password="" ) {
        global $database;
        $username = $database->escape_value( $username );
        $password = $database->escape_value( $password );

        $result_array = User::find_by_sql( "
            SELECT * FROM users WHERE
            username = '{$username}' AND
            password = '{$password}'
            LIMIT 1;
        ");

        return( !empty( $result_array )) ? array_shift( $result_array ) : false;
    }
}

?>
