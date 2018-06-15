<?php
require_once dirname(__FILE__) . "/SourceInterface.php";
require_once dirname(__FILE__) . "/../../daos/FileDao.php";

/**
 * Class for reading / writing players from / to files.
 */
class FileService implements SourceInterface {
    
    private $fileDao;
    
    public function __construct() {
        $this->fileDao = new FileDao();
    }
    
    /**
     * 
     * @param type $fileName
     */
    public function getData( $fileName = null ) {
        return $this->fileDao->getData( $fileName );
    }
    
    /**
     * 
     * @param type $fileName
     * @param type $players
     */
    public function writePlayers( $fileName, $players ) {
        
    }
}