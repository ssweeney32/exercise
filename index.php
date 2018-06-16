<?php
require_once dirname(__FILE__) . "/controllers/IndexController.php";
$controller = new IndexController();

// test 1 - simple read from array and display cli
//$controller->readAndDisplay( "cli", "array" );

// test 2 - simple ready from file and diplay html
//$file1 = "/home/sean/Projects/RateHubExercise/docs/data/playerdata.json";
//$controller->readAndDisplay( "cli", "file", $file1 );

// test 3 - read from json then add a new new player and display cli
/*
$player = new \stdClass();
$player->name = 'Test Test';
$player->age = 100;
$player->job = 'Center';
$player->salary = '0.66m';
$controller->readAddPlayerAndDisplay( "cli", "json", $player );
*/

// test 4 - add a player, display, read w overwite, display
/*
$player = new \stdClass();
$player->name = 'Test Test';
$player->age = 100;
$player->job = 'Center';
$player->salary = '0.66m';
$controller->addPlayerDisplayThenReadAndDisplay( "cli", "json", $player );
*/

// test 5 - write player to a file
/*
$player = new \stdClass();
$player->name = 'Test Test';
$player->age = 100;
$player->job = 'Center';
$player->salary = '0.66m';
$file2 = "/home/sean/Projects/RateHubExercise/docs/data/playerdata_test.json";
$controller->writePlayerToFile( $file2, $player );
*/