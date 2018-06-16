<?php

/**
 * 
 */
interface IReadWritePlayers {
    function readPlayers($source, $filename = null);
    function display($viewType);
}
