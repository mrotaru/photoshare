<?php
require_once(LIB_PATH.DS.'database.php');
require_once(LIB_PATH.DS.'database_object.php');

class Photograph extends DatabaseObject {

    // attributes
    protected static $table_name="photographs";
    protected static $db_fields=array('id', 'filename', 'type', 'size', 'caption');
    public $id;
    public $filename;
    public $type;
    public $size;
    public $caption;
    public $errors=array();

    private $temp_path;
    private $upload_dir = "images";

    protected $upload_errors = array(
        // http://www.php.net/manual/en/features.file-upload.errors.php
        UPLOAD_ERR_OK 				=> "No errors.",
        UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
        UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
        UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
        UPLOAD_ERR_NO_FILE 		=> "No file.",
        UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
        UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
        UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
    );

    // try and build a Photograph object (set it's attributes ) 
    // from the $_FILE[] passed as a parameter. Returns true if successful.
    //--------------------------------------------------------------------------
    public function attach_file( $file ) {
        if( !$file || empty( $file ) || !is_array( $file )) {
            $this->errors[] = "No file was uploaded.";
            return false;
        } else if( $file[ 'error' ] != 0 ) {
            $this->errors[] = $upload_errors[ $file[ 'error' ]];
            return false;
        } else {
            $this->temp_path    = $file[ 'tmp_name' ];
            $this->filename     = basename( $file[ 'name' ] );
            $this->type         = $file[ 'type' ];
            $this->size         = $file[ 'size' ];
        }
        return true;
    }

    // copy the uploaded image to the server's filesystem 
    // NOTE: overriding DatabaseObject::save()
    //--------------------------------------------------------------------------
    public function save() {
        if( isset( $this->id )) {
            $this->update();
        } else {
            if( !empty( $this->errors )) { return false; }
                if( strlen( $this->caption ) > 255 ) {
                    $this->errors[] = "The caption can have maximum 255 characters.";
                    return false;
                }

            if( empty( $this->filename ) || empty( $this->temp_path )) {
                $this->errors[] = "The file location was not available";
                return false;
            }

            $upload_path = SITE_ROOT.DS.'public'.DS.$this->upload_dir;
            // check if destination folder exists, and create it if not
            if( !is_dir( $upload_path )) {
                mkdir( $upload_path, 0744 );
            }

            // check if destination folder is writable
            if( !is_dir( $upload_path ) || !is_writable( $upload_path )) {
                $this->errors[] = "The upload folder cannot be created or is not writable.";
                return false;
            }

            // Determine the target_path
            $target_path = SITE_ROOT .DS. 'public' .DS. $this->upload_dir .DS. $this->filename;

            // Make sure a file doesn't already exist in the target location
            if( file_exists( $target_path )) {
                $this->errors[] = "The file {$this->filename} already exists.";
                return false;
            }

            // Attempt to move the file 
            if( move_uploaded_file( $this->temp_path, $target_path )) {
                if($this->create()) {
                    unset($this->temp_path); // We are done with temp_path, the file isn't there anymore
                    return true;
                }
            } else { // File was not moved.
                $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
                return false;
            }
        }
    }
}

?>
