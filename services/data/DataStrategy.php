<?php
require_once dirname(__FILE__) . "/ArrayService.php";
require_once dirname(__FILE__) . "/FileService.php";
require_once dirname(__FILE__) . "/JsonService.php";

/**
 * Strategy for wrapping various data sources.
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
     * Fetch the players from the source that has been defined
     * 
     * @param string $fileName
     * @return array
     */
    public function getPlayers( $fileName = null ) {
        $players = [];
        
        if ( $this->dataService != null ) {
            $players = $this->dataService->getPlayers( $fileName );
        }
        
        return $players;
    }
}