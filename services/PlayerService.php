<?php
require_once dirname(__FILE__) . "/../daos/ArrayDao.php";
require_once dirname(__FILE__) . "/../daos/JsonDao.php";
require_once dirname(__FILE__) . "/../daos/FileDao.php";
require_once dirname(__FILE__) . "/../services/display/CliService.php";
require_once dirname(__FILE__) . "/../services/display/HtmlService.php";

interface IReadWritePlayers {
    function readPlayers($source, $filename = null);
    function writePlayer($source, $player, $filename = null);
    function display($isCLI, $course, $filename = null);
}

class PlayersObject implements IReadWritePlayers {

    private $playersArray;

    private $playerJsonString;
    
    private $arrayDao;
    private $fileDao;
    private $jsonDao;
    private $cliService;
    private $htmlService;

    public function __construct() {
        //We're only using this if we're storing players as an array.
        $this->playersArray = [];

        //We'll only use this one if we're storing players as a JSON string
        $this->playerJsonString = null;
        
        $this->arrayDao = new ArrayDao();
        $this->fileDao = new FileDao();
        $this->jsonDao = new JsonDao();
        
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
                $playerData = $this->arrayDao->getData();
                break;
            case 'json':
                $playerData = $this->jsonDao->getData();
                break;
            case 'file':
                $playerData = $this->fileDao->getData($filename);
                break;
        }

        if (is_string($playerData)) {
            $playerData = json_decode($playerData);
        }

        return $playerData;

    }

    /**
     * @param $source string Where to write the data. 'json', 'array' or 'file'
     * @param $filename string Only used if we're writing in 'file' mode
     * @param $player \stdClass Class implementation of the player with name, age, job, salary.
     */
    function writePlayer($source, $player, $filename = null) {
        switch ($source) {
            case 'array':
                $this->playersArray[] = $player;
                break;
            case 'json':
                $players = [];
                if ($this->playerJsonString) {
                    $players = json_decode($this->playerJsonString);
                }
                $players[] = $player;
                $this->playerJsonString = json_encode($player);
                break;
            case 'file':
                $players = json_decode($this->getPlayerDataFromFile($filename));
                if (!$players) {
                    $players = [];
                }
                $players[] = $player;
                file_put_contents($filename, json_encode($players));
                break;
        }
    }

    function display($isCLI, $source, $filename = null) {

        $players = $this->readPlayers($source, $filename);

        if ($isCLI) {
            $this->cliService->display( $players );
        } else {
            $this->htmlService->display( $players );
        }
    }

}
?>