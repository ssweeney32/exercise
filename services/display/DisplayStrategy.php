<?php
require_once dirname(__FILE__) . "/CliService.php";
require_once dirname(__FILE__) . "/HtmlService.php";

/**
 * Strategy for wrapping various display options.
 */
class DisplayStrategy {
    
    private $viewService = null;
    
    public function __construct( $viewType ) {
        switch ( $viewType ) {
            case "cli":
                $this->viewService = new CliService();
                break;
            case "html":
                $this->viewService = new HtmlService();
                break;
            default:
                throw new InvalidArgumentException("Illegal view type");
        }
    }
    
    /**
     * Display the data
     * 
     * @param array $players
     */
    public function display( $players ) {
        if ( $this->viewService != null ) {
            $this->viewService->display( $players );
        }
    }
}