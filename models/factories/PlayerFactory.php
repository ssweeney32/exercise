<?php
require_once dirname(__FILE__) . "/../Player.php";

class PlayerFactory {

    public static function buildFromStdClass( $data ) {
    	return new Player( $data->name, $data->age, $data->job, $data->salary );
    }
}