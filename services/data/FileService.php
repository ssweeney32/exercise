<?php
require_once dirname(__FILE__) . "/SourceInterface.php";
require_once dirname(__FILE__) . "/BaseDataService.php";
require_once dirname(__FILE__) . "/../../daos/FileDao.php";
require_once dirname(__FILE__) . "/../../models/factories/PlayerFactory.php";

/**
 * Class for reading / writing players from / to files.
 */
class FileService extends BaseDataService implements SourceInterface {
    
    private $fileDao;
    
    public function __construct() {
        $this->fileDao = new FileDao();
    }
    
    /**
     * Fetch the player data and return player objects
     * 
     * @param string $fileName
     */
    public function getPlayers( $fileName = null ) {
        $data = $this->fileDao->getData( $fileName );
        return $this->processRawDataToPlayers( $data );
    }
    
    /**
     * 
     * @param string $fileName
     * @param Player $newPlayer
     */
    public function writePlayerToFile( $fileName, $newPlayer ) {
        $storedPlayers = $this->fileDao->getData( $fileName );
        
        if (!$storedPlayers) {
            $$storedPlayers = [];
        }
        
        $storedPlayers[] = $newPlayer;
        file_put_contents( $fileName, json_encode($storedPlayers) );
    }
}