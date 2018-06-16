<?php

/**
 * 
 */
interface IReadWritePlayers {
    function readPlayers($source, $filename = null);
    function writePlayerToFile( $fileName, $rawPlayer );
    function display($viewType);
}
