<?php
require_once "DisplayInterface.php";

/**
 * Service for html display.
 */
class HtmlService implements DisplayInterface {

    /**
     * Display an array of players
     */
    public function display ( $players ) {
        ?>
            <!DOCTYPE html>
            <html>
            <head>
                <style>
                    li {
                        list-style-type: none;
                        margin-bottom: 1em;
                    }
                    span {
                        display: block;
                    }
                </style>
            </head>
            <body>
            <div>
                <span class="title">Current Players</span>
                <ul>
                    <?php
                        if ( count($players) > 0 ) {
                            foreach ( $players as $player ) { 
                                $this->displayPlayer( $player );
                            }
                        } else {
                            ?>
                            No players!
                            <?php
                        }
                    ?>
                </ul>
            </body>
            </html><?php
    }
    
    /**
     * Print a player out
     * 
     * @param Player $player
     */
    private function displayPlayer( $player ) {
        ?>
        <li>
            <div>
                <span class="player-name">Name: <?= $player->getName() ?></span>
                <span class="player-age">Age: <?= $player->getAge() ?></span>
                <span class="player-salary">Salary: <?= $player->getSalary() ?></span>
                <span class="player-job">Job: <?= $player->getJob() ?></span>
            </div>
        </li>
        <?php        
    }
}