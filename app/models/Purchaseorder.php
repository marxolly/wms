<?php
 /**
  * Purchaseorder Class
  *

  * @author     Mark Solly <mark.solly@fsg.com.au>

  FUNCTIONS

  */
class Purchaseorder extends Model{
    public $table = "purchase_orders";
    public $items_table = "purchase_order_items";

    public function addPurchaseOrder($data)
    {
        //echo "<pre>",print_r($data),"</pre>"; die();
        $db = Database::openConnection();
        $items = $data['poitems'];
        $vals = array(
            'finisher_id'   => $data['finisher_id'],
            'date'          => $data['date_value']
        );
        if(empty($data['required_date_value']))
            $vals['due_date'] = $data['required_date'];
        else
            $vals['due_date'] = $data['required_date_value'];
        if(!empty($data['fsg_job_no']))
            $vals['fsg_job_no'] = $data['fsg_job_no'];
        if(!empty($data['fsg_quote_no']))
            $vals['fsg_quote_no'] = $data['fsg_quote_no'];
        $po_id = $db->insertQuery($this->table, $vals);
        $po_no = $this->generatePONumber($po_id);
        $db->updateDatabaseField($this->table, "po_no", $po_no, $po_id);
        foreach($items as $i => $item)
        {
            $item['po_id'] = $po_id;
            unset($item['item_id']);
            $db->insertQuery($this->items_table, $item);
        }
        return $po_id;
    }

    public function getPoById($id)
    {
        $db = Database::openConnection();
        $q = $this->getPOQuery();
        $q .= "
            HAVING po.id = $id
        ";
        $a = array($id);
        return $db->queryData($q);
    }

    private function getPOQuery()
    {
        return "
            SELECT
                po.*,
                GROUP_CONCAT(
                    IFNULL(poi.id,''),',',
                    IFNULL(poi.qty,''),',',
                    IFNULL(poi.description,'')
                    SEPARATOR '|'
                ) AS `items`
            FROM
                `purchase_orders` po LEFT JOIN
                `purchase_order_items` poi ON po.id = poi.po_id
            GROUP BY
                po.id
        ";
    }

    private function generatePONumber($po_id)
    {
        return  "0".date('y')."-".str_pad($po_id,5,"0",STR_PAD_LEFT);
    }
}
?>