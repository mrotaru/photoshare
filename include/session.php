<?php

// it is not advisable to keep DB objects in sessions because:
// - they can become stale (the database can be update, therefore
//   rendering the session's copy out-of-sync with the DB )
// - objects can be quite large
class Session {

    // attributes
    private $logged_in = false;
    public $user_id;

    // constructors / destructors
    //--------------------------------------------------------------------------
    function __construct() {
        session_start();
        $this->check_login();
    }

    // methods
    //--------------------------------------------------------------------------
    private function check_login() {
        if( isset( $_SESSION[ 'user_id' ] )) {
            $this->user_id = $_SESSION[ 'user_id' ];
            $this->logged_in = true;
        } else {
            unset( $this->user_id );
            $this->logged_in = false;
        }
    }

    //--------------------------------------------------------------------------
    public function is_logged_in() {
        return $this->logged_in;
    }

    //--------------------------------------------------------------------------
    public function login( $user ) {
        if( $user ) {
            $this->user_id = $_SESSION[ 'user_id' ] = $user->id;
            $this->logged_in = true;
        }
    }

    //--------------------------------------------------------------------------
    public function logout( $user ) {
        unset( $_SESSION[ 'user_id' ] );
        unset( $this->user_id );
        $this->logged_in = false;
    }
}

$session = new Session();

?>
