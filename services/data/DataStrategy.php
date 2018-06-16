<?php
require_once dirname(__FILE__) . "/ArrayService.php";
require_once dirname(__FILE__) . "/FileService.php";
require_once dirname(__FILE__) . "/JsonService.php";

/**
 * 
 */
class DataStrategy {
    
    private $dataService = null;
    
    public function __construct( $viewType ) {
        switch ( $viewType ) {
            case 'array':
                $this->dataService = new ArrayService();
                break;
            case 'json':
                $this->dataService = new JsonService();
                break;
            case 'file':
                $this->dataService = new FileService();
                break;
            default:
                throw new InvalidArgumentException("Illegal data source type");
        }
    }
    
    /**
     * 
     * @param type $fileName
     */
    public function getPlayers( $fileName = null ) {
        if ( $this->dataService != null ) {
            $this->dataService->getPlayers( $fileName );
        }
    }
}