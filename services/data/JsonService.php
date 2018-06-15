<?php
require_once dirname(__FILE__) . "/SourceInterface.php";
require_once dirname(__FILE__) . "/../../daos/JsonDao.php";

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
    public function getData() {
        return $this->jsonDao->getData();
    }
}