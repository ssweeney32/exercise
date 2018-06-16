<?php

/**
 * Collection of players.
 */
class PlayerList {
    
    private $players = [];
    
    public function __construct( $players = [] ) {
        $this->players = $players;
    }
    
    /**
     * Return the players list
     * 
     * @return array
     */
    public function getPlayers() {
        return $this->players;
    }
    
    /**
     * Add a player to the list
     * 
     * @param Player $player
     */
    public function addPlayer( $player ) {
        $this->players[] = $player;
    }
    
    /**
     * Merge an array of players with the existing collection
     * 
     * @param type $players
     */
    public function addPlayers ( $players ) {
        $this->players = array_merge( $this->players, $players );
    }
    
    /**
     * Clear all players
     */
    public function clearPlayers() {
        $this->players = [];
    }
}