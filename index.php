<?php
require_once dirname(__FILE__) . "/services/PlayerService.php";
$playersObject = new PlayersObject();
$playersObject->display(php_sapi_name() === 'cli', 'array');
?>