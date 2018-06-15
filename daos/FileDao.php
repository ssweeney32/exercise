<?php
require_once "AbstractDao.php";

/**
 * DAO for file source
 */
class FileDao extends AbstractDao {
    
    /**
     * 
     * @param type $filename
     * @return type
     * @throws InvalidArgumentException
     */
    public function getData( $filename = null ) {
        $data = [];

        if ( $filename != null && $filename != "" ) {
            $rawData = file_get_contents( $filename );
            $data = json_decode( $rawData );
        } else {
            throw new InvalidArgumentException("Illegal filename argument");
        }

        return $data;
    }
}