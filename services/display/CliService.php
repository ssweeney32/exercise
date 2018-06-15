<?php
require_once "DisplayInterface.php";

/**
 * Service for cli display.
 */
class CliService implements DisplayInterface {

    /**
     *
     */
    public function display ( $players ) {
        echo "Current Players: \n";
        foreach ($players as $player) {

            echo "\tName: " .$player->getName() . "\n";
            echo "\tAge: " .$player->getAge() . "\n";
            echo "\tSalary: " .$player->getSalary() . "\n";
            echo "\tJob: " .$player->getJob() . "\n\n";
        }
    }
}