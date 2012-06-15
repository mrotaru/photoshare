<?php
require_once( "init.php" );

class Logger {

    // attributes
    public $log_file_name = "log.txt";
    public $logs_folder;
    public $date_format = "%Y-%m-%d %H:%M:%S";
    private $log_file_handle;
    private $log_file_full_path;

    // constructors / destructors
    //--------------------------------------------------------------------------
    function __construct() {
        $this->logs_folder = SITE_ROOT . DS . "logs";
        $this->log_file_full_path = $this->logs_folder . DS . $this->log_file_name;

        // check that log file exists, create it if it doesn't
        if( !file_exists( $this->log_file_full_path )) {
            $this->log_file_handle = fopen( $this->log_file_full_path, 'w' );
        } else {
            $this->log_file_handle = fopen( $this->log_file_full_path, 'a' );
        }
        
        // can't open and write to file
        if( !$this->log_file_handle )
            die( "Cannot open {$this->log_file_name} and write to it." );
    }

    // methods
    //--------------------------------------------------------------------------
    public function log_action( $action, $message ) {
        $this->log_file_handle = fopen( $this->log_file_full_path, 'a' );
        if( !$this->log_file_handle )
            die( "Cannot open {$this->log_file_name} and write to it." );
        $str = strftime( $this->date_format, time() );
        $str .= " | " . $action . ": " . $message . "\r\n";
        fwrite( $this->log_file_handle, $str );
        fclose( $this->log_file_handle );
    }

    //--------------------------------------------------------------------------
    public function get_log_file_contents() {
        if( file_exists( $this->log_file_full_path ) && is_readable( $this->log_file_full_path )
            && $this->log_file_handle = fopen( $this->log_file_full_path, 'r' ) ) {
            return file_get_contents( $this->log_file_full_path );
            fclose( $this->log_file_handle );
        } else {
            die( "Cannot read from the log file." );
        }
    }

    //--------------------------------------------------------------------------
    public function clear_log_file( $user = null ) {
        $this->log_file_handle = fopen( $this->log_file_full_path, 'w' );
        fwrite( $this->log_file_handle, "" );
        fclose( $this->log_file_handle );
        $this->log_action( "LOG", "CLEARED" . ( $user? " by {$user->username}" : "" ) );
    }
}

$logger = new Logger();
?>
