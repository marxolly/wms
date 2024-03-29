<?php
 /**
  * Deliveryclientsbay Class
  *

  * @author     Mark Solly <mark.solly@fsg.com.au>


  FUNCTIONS

  getBayUsage($from, $to)
  getClientSpaceUsage($date, $client_id = 0)
  getCurrentBayUsage($client_id)
  getSpaceUsage($from, $to, $client_id = 0)
  stockAdded($client_id, $location_id)
  stockRemoved($client_id, $location_id, $product_id)

  */
class Deliveryclientsbay extends Model{
    public $table = "delivery_clients_bays";

    public function getCurrentBayUsage($client_id)
    {
        $db = Database::openConnection();
        $bays = $db->queryData("
            SELECT * FROM {$this->table} WHERE client_id = $client_id AND date_removed = 0;
        ");

        return $bays;
    }

    public function getSpaceUsage($from, $to, $client_id = 0)
    {
        $db = Database::openConnection();
        $excluded_location_ids = [
            2914,   //backorders
            2922    //collection items
        ];
        $q = "
        SELECT
            cb.id AS client_bay_id, cb.date_added, cb.date_removed, cb.size,
            dh.dh AS days_held,
            FROM_UNIXTIME(cb.date_added) AS DATE_ADDED,
            FROM_UNIXTIME(cb.date_removed) AS DATE_REMOVED,
            l.location, l.tray,
            c.client_name,
            CONCAT(i.name,'( ',i.sku,' )') AS item_name,
            FROM_UNIXTIME($from) AS DATE_FROM,
            FROM_UNIXTIME($to) AS DATE_TO
        FROM
            delivery_clients_bays cb JOIN
            (
                SELECT
                    CASE
                        delivery_clients_bays.date_removed
                    WHEN
                        0
                    THEN
                        CASE
                            WHEN
                                delivery_clients_bays.date_added < $from
                            THEN
                                DATEDIFF(
                                    FROM_UNIXTIME($to),
                                    FROM_UNIXTIME($from)
                                )
                            ELSE
                                DATEDIFF(
                                    FROM_UNIXTIME($to),
                                    FROM_UNIXTIME(delivery_clients_bays.date_added)
                                )
                		END
                    ELSE
                        CASE
                            WHEN
                                delivery_clients_bays.date_added < $from
                            THEN
                                CASE
                                    WHEN
                                        delivery_clients_bays.date_removed > $to
                                    THEN
                                        DATEDIFF(
                                            FROM_UNIXTIME($to),
                                            FROM_UNIXTIME($from)
                                        )
                                    ELSE
                                        DATEDIFF(
                                            FROM_UNIXTIME(delivery_clients_bays.date_removed),
                                            FROM_UNIXTIME($from)
                                        )
                                END
                            ELSE
                                CASE
                                    WHEN
                                        delivery_clients_bays.date_removed > $to
                                    THEN
                                        DATEDIFF(
                                            FROM_UNIXTIME($to),
                                            FROM_UNIXTIME(delivery_clients_bays.date_added )
                                        )
                                    ELSE
                                        DATEDIFF(
                                            FROM_UNIXTIME(delivery_clients_bays.date_removed),
                                            FROM_UNIXTIME(delivery_clients_bays.date_added)
                                        )
                                END
                        END
                    END AS dh,
                    delivery_clients_bays.id
                FROM
                    delivery_clients_bays
                HAVING
                	dh > 0
            ) dh ON cb.id = dh.id JOIN
            locations l ON l.id = cb.location_id JOIN
            items i ON cb.item_id = i.id JOIN
            clients c ON cb.client_id = c.id
        WHERE
            c.delivery_client = 1 AND cb.location_id NOT IN(".implode(",",$excluded_location_ids).")";
        if($client_id > 0)
            $q .= " AND cb.client_id = $client_id ";
        $q .= "
        ORDER BY
            c.client_name
        ";
        //die($q);
        return $db->queryData($q);
    }

    public function getClientSpaceUsage($date, $client_id = 0)
    {
        $db = Database::openConnection();
        $excluded_location_ids = [
            2914,   //backorders
            2922    //collection items
        ];
        $q = "
        SELECT
            cb.id AS client_bay_id, cb.date_added, cb.date_removed, cb.size,
            dh.dh AS days_held,
            FROM_UNIXTIME(cb.date_added) AS DATE_ADDED,
            FROM_UNIXTIME(cb.date_removed) AS DATE_REMOVED,
            l.location,
            l.tray,
            c.client_name,
            CONCAT(i.name,'( ',i.sku,' )') AS item_name,
            FROM_UNIXTIME($date) AS THE_DATE
        FROM
            delivery_clients_bays cb JOIN
            (
                SELECT
                    CASE
                    WHEN
                        delivery_clients_bays.date_removed = 0
                    THEN
                        DATEDIFF(
                            FROM_UNIXTIME($date),
                            FROM_UNIXTIME(delivery_clients_bays.date_added)
                        )
                    WHEN
                        delivery_clients_bays.date_removed > $date
                    THEN
                        DATEDIFF(
                            FROM_UNIXTIME($date),
                            FROM_UNIXTIME(delivery_clients_bays.date_added)
                        )
                    ELSE
                        DATEDIFF(
                            FROM_UNIXTIME(delivery_clients_bays.date_removed),
                            FROM_UNIXTIME(delivery_clients_bays.date_added)
                        )
                    END AS dh,
                    delivery_clients_bays.id
                FROM
                    delivery_clients_bays
                HAVING dh > 0
            ) dh ON cb.id = dh.id JOIN
            locations l ON l.id = cb.location_id JOIN
            items i ON cb.item_id = i.id
            JOIN clients c ON cb.client_id = c.id
        WHERE
            c.delivery_client = 1 AND
            cb.location_id NOT IN(2914,2922) AND
            cb.client_id = $client_id
        HAVING
            DATE(FROM_UNIXTIME(cb.date_added)) < THE_DATE
        ORDER BY
            cb.date_added
        ";
        //die($q);
        return $db->queryData($q);
    }

    public function stockAdded($data)
    {
        $db = Database::openConnection();
        $db->insertQuery($this->table, array(
            'client_id'     => $data['client_id'],
            'location_id'   => $data['location_id'],
            'item_id'       => $data['item_id'],
            'size'          => $data['size'],
            'date_added'    => time()
        ));
        return true;
    }

    public function stockRemoved($client_id, $location_id, $item_id)
    {
        $db = Database::openConnection();
        $this_row = $db->queryRow("
            SELECT *
            FROM {$this->table}
            WHERE date_removed = 0 AND client_id = $client_id AND location_id = $location_id AND item_id = $item_id
        ");
        if(empty($this_row))
        {
            //get the date_added value
            $cbr = $db->queryRow("SELECT MAX(date_added) AS date_added FROM clients_bays WHERE client_id = $client_id AND location_id = $location_id");
            $date_added = $cbr['date_added'];
            //echo $date_added;
            $db->insertQuery($this->table, array(
                'client_id'     => $client_id,
                'location_id'   => $location_id,
                'item_id'       => $item_id,
                'date_added'	=> $date_added,
                'date_removed'  => time()
            ));
        }
        else
            $db->updateDatabaseField($this->table, 'date_removed', time(), $this_row['id']);
        return true;
    }

    public function getBaySize($location_id, $client_id, $item_id)
    {
        $db = Database::openConnection();
        if($size =  $db->queryValue($this->table,['location_id' => $location_id, 'client_id' => $client_id, 'item_id' => $item_id], 'size'))
            return $size;
        else
            return "standard";
    }
}
?>