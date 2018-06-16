<?php
require_once "DisplayInterface.php";

/**
 * Service for cli display.
 */
class CliService implements DisplayInterface {

    /**
     * Display an array of players
     */
    public function display ( $players ) {
        echo "Current Players: " . PHP_EOL;
        foreach ($players as $player) {
            $this->displayPlayer( $player );
        }
    }
    
    /**
     * Print a player out
     * 
     * @param Player $player
     */
    private function displayPlayer( $player ) {
        echo $this->formatLine( "Name", $player->getName() );
        echo $this->formatLine( "Age", $player->getAge() );
        echo $this->formatLine( "Salary", $player->getSalary() );
        echo $this->formatLine( "Job", $player->getJob() );
        echo PHP_EOL;
    }
    
    /**
     * 
     * @param string $label
     * @param string $value
     * @return type
     */
    private function formatLine( $label, $value ) {
        return "\t" . $label . ": " .$value . PHP_EOL;
    }
}