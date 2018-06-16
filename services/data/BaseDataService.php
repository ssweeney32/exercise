<?php
require_once dirname(__FILE__) . "/../../models/factories/PlayerFactory.php";

/**
 * Base class for data services
 */
abstract class BaseDataService {
    
    /**
     * Takes an array of StdClass' and transforms them into Player objects.
     * 
     * @param array $data
     * @return array
     */
    protected function processRawDataToPlayers( $data ) {
        $players = [];
        
        foreach( $data as $player ) {
            $players[] = PlayerFactory::buildFromStdClass( $player );
        }
        
        return $players;
    }
}