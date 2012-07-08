<?php
require_once( "init.php" );
require_once(LIB_PATH . DS .'database.php');

class Comment extends DatabaseObject {

    // attributes
    protected static $table_name="comments";
    protected static $db_fields=array('id', 'user_id', 'photo_id', 'created', 'body' );

    public $id;
    public $user_id;
    public $photo_id;
    public $created;
    public $body;

    public static function generate( $photo_id, $user_id, $body ) {
        if( empty( $photo_id) || empty( $user_id ) || empty( $body ) ) return false;
        $com = new Comment();
        $com->photo_id = $photo_id;
        $com->created = strftime( "%Y-%m-%d %H:%M:%S", time() );
        $com->user_id = $user_id;
        $com->body = $body;
        return $com;
    }

    public static function find_comments_on( $photo_id ) {
        global $database;
        $sql  = "SELECT * FROM comments";
        $sql .= " WHERE photo_id=" . $database->escape_value( $photo_id );
        $sql .= " ORDER BY created ASC;";
        return self::find_by_sql( $sql );
    }
}

?>
