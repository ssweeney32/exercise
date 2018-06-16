<?php
require_once dirname(__FILE__) . "/IReadWritePlayers.php";
require_once dirname(__FILE__) . "/data/DataStrategy.php";
require_once dirname(__FILE__) . "/data/FileService.php";
require_once dirname(__FILE__) . "/display/DisplayStrategy.php";
require_once dirname(__FILE__) . "/../models/factories/PlayerFactory.php";
require_once dirname(__FILE__) . "/../models/PlayerList.php";

/**
 * Class for managing the reading / writing of players.
 */
class PlayerService implements IReadWritePlayers {

    private $playersCollection = null;
    private $fileService = null;
    
    public function __construct() {
        $this->playersCollection = new PlayerList();
        $this->fileService = new FileService();
    }

    /**
     * Receive Player objects from a source and append them to the collection.
     * 
     * @param string $source
     * @param string $fileName
     */
    function readAndAppendPlayersToCollection( $source, $fileName = null ) {
        $players = $this->readPlayers( $source, $fileName );
        $this->playersCollection->addPlayers( $players );
    }
    
    /**
     * Receive Player objects from a source and add them to the collection as a new collection.
     * 
     * @param string $source
     * @param string $fileName
     */
    function readPlayersToCollectionWithOverwrite( $source, $fileName = null ) {
        $this->playersCollection->clearPlayers();
        $players = $this->readPlayers( $source, $fileName );
        $this->playersCollection->addPlayers( $players );
    }

    /**
     * Read and build Player objects from a provided data source.
     * 
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
     * @param /stdClass $rawPlayer
     */
    function appendPlayerToList( $rawPlayer ) {
        $player = PlayerFactory::buildFromStdClass( $rawPlayer );
        $this->playersCollection->addPlayer( $player );
    }
    
    /**
     * Note: remenants of the writePlayer function. Since the original 
     * write functionality was present in this file to facilitate writing a 
     * player I kept a simple function here to preform that. The actual 
     * functionality has been moved to FileService and that could / should 
     * be used directly by any services that require it.
     * 
     * @param string $fileName
     * @param /stdClass $rawPlayer
     */
    function writePlayerToFile( $fileName, $rawPlayer ) {
        $this->fileService->writePlayerToFile( $fileName, $rawPlayer );
    }
    
    /**
     * Given a set of players and a specified output, display the players collection.
     * 
     * @param string $viewType
     */
    function display( $viewType ) {
        $displayStrategy = new DisplayStrategy( $viewType );
        $displayStrategy->display( $this->playersCollection->getPlayers() );
    }
    
    /**
     * Clear the collection
     */
    public function clearCollection() {
        $this->playersCollection->clearPlayers();
    }
}