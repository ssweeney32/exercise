<?php
require_once dirname(__FILE__) . "/../Player.php";

/**
 * Factory for building player objects.
 */
class PlayerFactory {

    public static function buildFromStdClass( $data ) {
    	return new Player( $data->name, $data->age, $data->job, $data->salary );
    }
}