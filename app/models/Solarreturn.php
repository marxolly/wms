<?php

/**
    * Solarreturn Class
    *

    * @author     Mark Solly <mark.solly@fsg.com.au>

        FUNCTIONS



    */

class Solarreturn extends Model{
    public $table = "solar_returns";

    public function addReturn($data)
    {
        $db = Database::openConnection();
        $values = array(
            'item_id'       => $data['item_id'],
            'solar_type_id' => $data['order_type_id'],
            'serial_number' => $data['serial_number'],
            'date_entered'  => time()
        );
        $return_id = $db->insertQuery($this->table, $values);

        return $return_id;
    }
}
?>