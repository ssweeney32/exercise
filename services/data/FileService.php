<?php
require_once dirname(__FILE__) . "/SourceInterface.php";
require_once dirname(__FILE__) . "/../../daos/FileDao.php";
require_once dirname(__FILE__) . "/../../models/factories/PlayerFactory.php";

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
    public function getPlayers( $fileName = null ) {
        $players = [];
        
        $data = $this->fileDao->getData( $fileName );
        
        foreach( $data as $player ) {
            $players[] = PlayerFactory::buildFromStdClass( $player );
        }
        
        return $players;
    }
    
    /**
     * 
     * @param type $fileName
     * @param type $newPlayer
     */
    public function writePlayerToFile( $fileName, $newPlayer ) {
        $storedPlayers = $this->getData($fileName);
        
        if (!$storedPlayers) {
            $$storedPlayers = [];
        }
        
        $storedPlayers[] = $newPlayer;
        file_put_contents( $fileName, json_encode($storedPlayers) );
    }
}