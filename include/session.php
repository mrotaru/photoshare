<?php
require_once( "logger.php" );
require_once( "functions.php" );

// it is not advisable to keep DB objects in sessions because:
// - they can become stale (the database can be update, therefore
//   rendering the session's copy out-of-sync with the DB )
// - objects can be quite large
class Session {

    // attributes
    private $logged_in = false;
    public $user_id;
    public $message;

    // constructors / destructors
    //--------------------------------------------------------------------------
    function __construct() {
        session_start();
        $this->check_message();
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
            global $logger;
            $logger->log_action( "LOGIN", $user->username . " logged in." );
        }
    }

    //--------------------------------------------------------------------------
    public function logout() {
        unset( $_SESSION[ 'user_id' ] );
        unset( $this->user_id );
        $this->logged_in = false;

        // 2. Unset all the session variables
        $_SESSION = array();

        // 3. Destroy the session cookie
        if(isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-42000, '/');
        }

        // 4. Destroy the session
        session_destroy();

        redirect_to("../public/index.php");
    }

    //--------------------------------------------------------------------------
    private function check_message() {
        if( isset( $_SESSION[ 'message' ] )) {
            $this->message = $_SESSION[ 'message' ];
            unset( $_SESSION[ 'message' ] );
        } else {
            $this->message = "";
        }
    }

    //--------------------------------------------------------------------------
    public function message( $msg = "" ) {
        if( !empty( $msg )) {
            $_SESSION[ 'message' ] = $msg;
        } else {
            return $this->message;
        }
    }
}

$session = new Session();
$message = $session->message;
?>
