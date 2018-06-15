<?php
require_once dirname(__FILE__) . "/SourceInterface.php";
require_once dirname(__FILE__) . "/../../daos/ArrayDao.php";
require_once dirname(__FILE__) . "/../../models/factories/PlayerFactory.php";

/**
 * Class for reading players an array.
 */
class ArrayService implements SourceInterface {
    
    private $arrayDao;
    
    public function __construct() {
        $this->arrayDao = new ArrayDao();
    }
    
    /**
     * 
     * @param type $fileName
     */
    public function getPlayers() {
        $players = [];
        
        $data = $this->arrayDao->getData();
        
        foreach( $data as $player ) {
            $players[] = PlayerFactory::buildFromStdClass( $player );
        }
        
        return $players;
    }
}