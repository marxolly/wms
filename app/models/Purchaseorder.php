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
        $db = Database::openConnection();
        $items = $data['items'];
        unset($data['items']);
        $po_id = $db->insertQuery($this->table, $data);
        $po_no = $this->generatePONumber($po_id);
        $db->updateDatabaseField($this->table, "po_no", $po_no, $po_id);
        foreach($items as $item)
        {
            $item['po_id'] = $po_id;
            $db->insertQuery($this->items_table, $item);
        }
        return $po_id;
    }

    private function generatePONumber($po_id)
    {
        return  "0".date('y')."-".str_pad($po_id,5,"0",STR_PAD_LEFT);
    }
}
?>