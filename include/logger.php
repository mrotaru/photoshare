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
        if( !$this->log_file_handle )
            die( "Cannot open {$this->log_file_name} and write to it." );
    }

    // methods
    //--------------------------------------------------------------------------
    public function log_action( $action, $message ) {
        $str = strftime( $this->date_format, time() );
        $str .= " | " . $action . ": " . $message . "\r\n";
        fwrite( $this->log_file_handle, $str );
    }
}

$logger = new Logger();
?>
