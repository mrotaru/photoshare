<?php
require_once( "database.php" );

class User {

    // attributes
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $email;

    // returns an array of User objects, with all the users in the current db
    //--------------------------------------------------------------------------
    public static function find_all() {
        global $database;
        $result_array = self::find_by_sql( "SELECT * FROM Users" );
        return !empty( $result_array ) ? $result_array : false;
    }

    // returns the first User having the `id` passed as a parameter
    //--------------------------------------------------------------------------
    public static function find_by_id( $id=0 ) {
        global $database;
        $result_array = self::find_by_sql( "SELECT * FROM users WHERE id={$id} LIMIT 1" );
        return !empty( $result_array ) ? array_shift( $result_array ) : false;
    }

    // returns and array of User objects selected by running the `sql` query
    //--------------------------------------------------------------------------
    public static function find_by_sql( $sql="" ) {
        global $database;
        $result_set = $database->query( $sql );
        $object_array = array();
        while( $row = $database->fetch_array( $result_set ) ) {
            $object_array[] = self::instantiate( $row );
        }
        return $object_array;
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

    // concatenates the current object's first_name and last_name
    //--------------------------------------------------------------------------
    public function full_name() {
        if( isset( $this->first_name) && isset( $this->last_name ) ) {
            return $this->first_name . " " . $this->last_name;
        } else {
            return "";
        }
    }

    // returns an User object with the attributes set from the `record`
    //--------------------------------------------------------------------------
    private static function instantiate( $record ) {
        $object = new self;

        foreach( $record as $attribute=>$value ) {
            if( $object->has_attribute( $attribute ) ) {
                $object->$attribute = $value;
            }
        }

        return $object;
    }

    //--------------------------------------------------------------------------
    private function has_attribute( $attribute ) {
        $object_vars = get_object_vars( $this );
        return array_key_exists( $attribute, $object_vars );
    }
}

?>
