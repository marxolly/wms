<?php

 /**
  * Displaystyle Class
  *

  * @author     Mark Solly <mark.solly@fsg.com.au>
  * set displays to match client corporate colours

    FUNCTIONS



  */

class Displaystyle extends Model{

    public $table = "display_styles";

    public function recordData($data)
    {
        $db = Database::openConnection();
        $db->insertQuery($this->table, $data);
        return true;
    }

    public function getClientStyles($client_id = 0)
    {
        $db = Database::openConnection();
        $query = "SELECT * FROM {$this->table} WHERE `client_id` = $client_id";
        //die($query);
        return $db->queryRow($query);
    }

}
?>