<?php
require_once( "init.php" );
require_once( LIB_PATH . DS . "database.php" );

class DatabaseObject {

    // returns an array of User objects, with all the users in the current db
    //--------------------------------------------------------------------------
    public static function find_all() {
        global $database;
        $result_array = self::find_by_sql( "SELECT * FROM " . static::$table_name );
        return !empty( $result_array ) ? $result_array : false;
    }

    // returns the first Object having the `id` passed as a parameter
    //--------------------------------------------------------------------------
    public static function find_by_id( $id=0 ) {
        global $database;
        $result_array = self::find_by_sql( "SELECT * FROM " . static::$table_name . " WHERE id={$id} LIMIT 1" );
        if( !empty( $result_array )) {
            return array_shift( $result_array );
        } else {
            error_message( "Cannot find object with id={$id}." );
            return false;
        }
    }

    // returns and array of Objects selected by running the `sql` query
    //--------------------------------------------------------------------------
    public static function find_by_sql( $sql="" ) {
        global $database;
        $result_set = $database->query( $sql );
        $object_array = array();
        while( $row = $database->fetch_array( $result_set ) ) {
            $object_array[] = static::instantiate( $row );
        }
        return $object_array;
    }

    // returns an User object with the attributes set from the `record`
    //--------------------------------------------------------------------------
    private static function instantiate( $record ) {
        $class_name = get_called_class();
        $object = new $class_name;

        foreach( $record as $attribute=>$value ) {
            if( $object->has_attribute( $attribute ) ) {
                $object->$attribute = $value;
            }
        }

        return $object;
    }

    //--------------------------------------------------------------------------
    private function has_attribute( $attribute ) {
        return array_key_exists( $attribute, $this->attributes() );
    }

    //--------------------------------------------------------------------------
    protected function attributes() {
        $attributes = array();
        foreach( static::$db_fields as $field ) {
            if( property_exists( $this, $field )) {
                $attributes[ $field ] = $this->$field;
            }
        }
        return $attributes;
    }

    //--------------------------------------------------------------------------
    protected function sanitized_attributes() {
        global $database;
        $clean_attributes = array();
        foreach( $this->attributes() as $key => $value ) {
            $clean_attributes[ $key ] = $database->escape_value( $value );
        }
        return $clean_attributes;
    }

    //--------------------------------------------------------------------------
    public function save() {
        return isset( $this->id ) ? $this->update() : $this->create();
    }

    // insert the current object into the database
    //--------------------------------------------------------------------------
    protected function create() {
        global $database;
        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO " . static::$table_name . " ( ";
        $sql .= join( ", ", array_keys( $attributes ));
        $sql .= ") VALUES ( '";
        $sql .= join( "', '", array_values( $attributes ));
        $sql .= "' )";
        if( $database->query( $sql )) {
            $this->id = $database->insert_id();
            return true;
        } else {
            error_message( "Could not create object." );
            return false;
        }
    }

    //--------------------------------------------------------------------------
    protected function update() {
        global $database;
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach( $attributes as $key => $value ) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= join( ", ", $attribute_pairs );
        $sql .= " WHERE id='" . $database->escape_value( $this->id ) . "' ";
        $database->query( $sql );
        if( $database->affected_rows() == 0 ) error_message( "Could not update object." );
        return ( $database->affected_rows() == 1 ) ? true : false;
    }

    // note that the PHP instance will still be available, event though the
    // object was deleted from the database.
    //--------------------------------------------------------------------------
    public function delete() {
        global $database;
        $sql = "DELETE FROM " . static::$table_name . " 
                WHERE id=" . $database->escape_value( $this->id ) .
               " LIMIT 1";
        $database->query( $sql );
        if( $database->affected_rows() == 0 ) error_message( "Could not delete object." );
        return ( $database->affected_rows() == 1 ) ? true : false;
    }
}

?>
