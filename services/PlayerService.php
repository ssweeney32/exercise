<?php
require_once dirname(__FILE__) . "/data/ArrayService.php";
require_once dirname(__FILE__) . "/data/JsonService.php";
require_once dirname(__FILE__) . "/data/FileService.php";
require_once dirname(__FILE__) . "/../services/display/DisplayStrategy.php";
require_once dirname(__FILE__) . "/../models/factories/PlayerFactory.php";

interface IReadWritePlayers {
    function readPlayers($source, $filename = null);
    function display($isCLI, $course, $filename = null);
}

class PlayerService implements IReadWritePlayers {

    private $playersArray;

    public function __construct() {
        $this->playersArray = [];

        $this->arrayService = new ArrayService();
        $this->fileService = new FileService();
        $this->jsonService = new JsonService();
    }

    /**
     * @param $source string Where we're retrieving the data from. 'json', 'array' or 'file'
     * @param $filename string Only used if we're reading players in 'file' mode.
     * @return array
     */
    function readPlayers($source, $filename = null) {
        $playerData = null;

        switch ($source) {
            case 'array':
                $playerData = $this->arrayService->getPlayers();
                break;
            case 'json':
                $playerData = $this->jsonService->getPlayers();
                break;
            case 'file':
                $playerData = $this->fileService->getPlayers( $filename );
                break;
        }

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