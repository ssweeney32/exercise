<?php
require_once dirname(__FILE__) . "/../services/PlayerService.php";

/**
 * Main controller
 */
class IndexController {
    
    private $playerService = null;
    
    public function __construct() {
        $this->playerService = new PlayerService();
    }
    
    /**
     * Given a view, source and optional fileName, read data, process and display.
     * 
     * @param string $viewType
     * @param string $source
     * @param string $fileName
     */
    public function readAndDisplay( $viewType, $source, $fileName = null ) {
        $this->playerService->clearCollection();
        $this->playerService->readPlayersToCollectionWithOverwrite( $source, $fileName );
        $this->playerService->display( $viewType );
    }
    
    /**
     * Given a player object and a read source, read the source, add the extra player and display.
     * 
     * @param string $viewType
     * @param string $source
     * @param stdClass $player
     * @param string $fileName
     */
    public function readAddPlayerAndDisplay( $viewType, $source, $player, $fileName = null ) {
        $this->playerService->clearCollection();
        $this->playerService->appendPlayerToList( $player );
        $this->playerService->readAndAppendPlayersToCollection( $source, $fileName );
        $this->playerService->display( $viewType );
    }
    
    
    /**
     * Given a player object and a read source, add the player, read the source w overwrite and display.
     * 
     * @param string $viewType
     * @param string $source
     * @param stdClass $player
     * @param string $fileName
     */
    public function addPlayerDisplayThenReadAndDisplay( $viewType, $source, $player, $fileName = null ) {
        $this->playerService->clearCollection();
        $this->playerService->appendPlayerToList( $player );
        $this->playerService->display( $viewType );
        $this->playerService->readPlayersToCollectionWithOverwrite( $source, $fileName );
        $this->playerService->display( $viewType );
    }
    
    /**
     * Given a player and a file, write the player to file.
     * 
     * @param string $fileName
     * @param stdClass $rawPlayer
     */
    public function writePlayerToFile( $fileName, $rawPlayer ) {
        $this->playerService->writePlayerToFile( $fileName, $rawPlayer );
    }
}