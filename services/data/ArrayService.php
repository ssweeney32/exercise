<?php
require_once dirname(__FILE__) . "/SourceInterface.php";
require_once dirname(__FILE__) . "/BaseDataService.php";
require_once dirname(__FILE__) . "/../../daos/ArrayDao.php";

/**
 * Class for reading players an array.
 */
class ArrayService extends BaseDataService implements SourceInterface {
    
    private $arrayDao;
    
    public function __construct() {
        $this->arrayDao = new ArrayDao();
    }
    
    /**
     * Fetch the player data and return player objects
     * 
     * @param string $fileName
     */
    public function getPlayers() {
        $data = $this->arrayDao->getData();
        return $this->processRawDataToPlayers( $data );
    }
}