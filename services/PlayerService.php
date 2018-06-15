<?php
require_once dirname(__FILE__) . "/data/ArrayService.php";
require_once dirname(__FILE__) . "/data/JsonService.php";
require_once dirname(__FILE__) . "/data/FileService.php";
require_once dirname(__FILE__) . "/../services/display/CliService.php";
require_once dirname(__FILE__) . "/../services/display/HtmlService.php";

interface IReadWritePlayers {
    function readPlayers($source, $filename = null);
    function display($isCLI, $course, $filename = null);
}

class PlayerService implements IReadWritePlayers {

    private $playersArray;
    
    private $cliService;
    private $htmlService;

    public function __construct() {
        $this->playersArray = [];

        $this->arrayService = new ArrayService();
        $this->fileService = new FileService();
        $this->jsonService = new JsonService();
        
        $this->cliService = new CliService();
        $this->htmlService = new HtmlService();
    }

    /**
     * @param $source string Where we're retrieving the data from. 'json', 'array' or 'file'
     * @param $filename string Only used if we're reading players in 'file' mode.
     * @return string json
     */
    function readPlayers($source, $filename = null) {
        $playerData = null;

        switch ($source) {
            case 'array':
                $playerData = $this->arrayService->getData();
                break;
            case 'json':
                $playerData = $this->jsonService->getData();
                break;
            case 'file':
                $playerData = $this->fileService->getData($filename);
                break;
        }

        if (is_string($playerData)) {
            $playerData = json_decode($playerData);
        }

        return $playerData;

    }
    
    /**
     * 
     * @param /stdClass $player
     */
    function addPlayerToList( $player ) {
        $this->playersArray[] = $player;
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
     * @param type $isCLI
     * @param type $source
     * @param type $filename
     */
    function display($isCLI, $source, $filename = null) {

        $players = $this->readPlayers($source, $filename);

        if ($isCLI) {
            $this->cliService->display( $players );
        } else {
            $this->htmlService->display( $players );
        }
    }
}