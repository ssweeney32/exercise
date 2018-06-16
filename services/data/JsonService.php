<?php
require_once dirname(__FILE__) . "/SourceInterface.php";
require_once dirname(__FILE__) . "/BaseDataService.php";
require_once dirname(__FILE__) . "/../../daos/JsonDao.php";
require_once dirname(__FILE__) . "/../../models/factories/PlayerFactory.php";

/**
 * Class for reading players from a json string.
 */
class JsonService extends BaseDataService implements SourceInterface {
    
    private $jsonDao;
    
    public function __construct() {
        $this->jsonDao = new JsonDao();
    }
    
    /**
     * Fetch the player data and return player objects
     * 
     * @param string $fileName
     * @return array
     */
    public function getPlayers() {
        $rawData = $this->jsonDao->getData();
        $data = json_decode( $rawData );
        return $this->processRawDataToPlayers( $data );
    }
}