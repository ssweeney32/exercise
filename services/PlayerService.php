<?php
require_once dirname(__FILE__) . "/IReadWritePlayers.php";
require_once dirname(__FILE__) . "/data/DataStrategy.php";
require_once dirname(__FILE__) . "/display/DisplayStrategy.php";
require_once dirname(__FILE__) . "/../models/factories/PlayerFactory.php";

/**
 * Class for managing the reading / writing of players.
 */
class PlayerService implements IReadWritePlayers {

    private $playersArray = [];

    /**
     * @param $source string Where we're retrieving the data from. 'json', 'array' or 'file'
     * @param $fileName string Only used if we're reading players in 'file' mode.
     * @return array
     */
    function readPlayers($source, $fileName = null) {
        $dataStrategy = new DataStrategy( $source );
        $playerData = $dataStrategy->getPlayers( $fileName );
        return $playerData;

    }
    
    /**
     * Note: remenants of the writePlayer function. For json and array it 
     * seemed to just store state so, store state to one array instead of 
     * two different implementations, one of which had bugs.
     * 
     * @param /stdClass $player
     */
    function addPlayerToList( $player ) {
        $this->playersArray[] = PlayerFactory::buildFromStdClass( $player );
    }
    
    /**
     * Note: since the original write functionality was present in this file 
     * to facilitate writing a player I kept a simple function here to 
     * preform that. The actual functionality has been moved to FileService 
     * and that could / should be used directly by any services that require it.
     * 
     * @param type $fileName
     * @param type $player
     */
    function writePlayerToFile( $fileName, $player ) {
        $this->fileService->writePlayerToFile( $fileName, $player );
    }
    
    /**
     * 
     * @param type $viewType
     * @param type $source
     * @param type $filename
     */
    function display($viewType, $source, $filename = null) {
        $players = $this->readPlayers($source, $filename);
        $displayStrategy = new DisplayStrategy( $viewType );
        $displayStrategy->display( $players );
    }
}