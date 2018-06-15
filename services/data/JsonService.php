<?php
require_once dirname(__FILE__) . "/SourceInterface.php";
require_once dirname(__FILE__) . "/../../daos/JsonDao.php";
require_once dirname(__FILE__) . "/../../models/factories/PlayerFactory.php";

/**
 * Class for reading players from a json string.
 */
class JsonService implements SourceInterface {
    
    private $jsonDao;
    
    public function __construct() {
        $this->jsonDao = new JsonDao();
    }
    
    /**
     * 
     * @param type $fileName
     */
    public function getPlayers() {
        $players = [];
        
        $data = $this->jsonDao->getData();
        
        foreach( $data as $player ) {
            $players[] = PlayerFactory::buildFromStdClass( $player );
        }
        
        return $players;
    }
}