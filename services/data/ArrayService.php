<?php
require_once dirname(__FILE__) . "/SourceInterface.php";
require_once dirname(__FILE__) . "/../../daos/ArrayDao.php";

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
    public function getData() {
        return $this->arrayDao->getData();
    }
}