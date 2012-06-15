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


    //--------------------------------------------------------------------------
    public function save() {
        return isset( $this->id ) ? $this->update() : $this->create();
    }

    // insert the current user into the database
    //--------------------------------------------------------------------------
    protected function create() {
        global $database;
        $sql = "INSERT INTO users ( username, password, first_name, last_name, email 
                ) VALUES ( '";
        $sql .= $database->escape_value( $this->username ) . "', '";
        $sql .= $database->escape_value( $this->password ) . "', '";
        $sql .= $database->escape_value( $this->first_name ) . "', '";
        $sql .= $database->escape_value( $this->last_name ) . "', '";
        $sql .= $database->escape_value( $this->email ) . "' )";
        if( $database->query( $sql )) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }

    //--------------------------------------------------------------------------
    protected function update() {
        global $database;
        $sql = "UPDATE users SET ";
        $sql .= "username='" . $database->escape_value( $this->username ) . "', ";
        $sql .= "password='" . $database->escape_value( $this->password ) . "', ";
        $sql .= "first_name='" . $database->escape_value( $this->first_name ) . "', ";
        $sql .= "last_name='" . $database->escape_value( $this->last_name ) . "', ";
        $sql .= "email='" . $database->escape_value( $this->email ) . "' ";
        $sql .= "WHERE id='" . $database->escape_value( $this->id ) . "' ";
        $database->query( $sql );
        return ( $database->affected_rows() == 1 ) ? true : false;
    }

    //--------------------------------------------------------------------------
    public function delete() {
    }
}

?>
