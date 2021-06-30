<?php
/**
 * View PurchaseOrders Implementation of the DataTablesSS Class.
 *
 *
 * @author     Mark Solly <mark.solly@fsg.com.au>
 */
 class ViewPurchaseOrders extends DataTablesSS
 {
    private static $return_array       = array();
    private static $table              = "purchase_orders";
    private static $items_table        = "purchase_order_itemsitems";
    private static $columns            = array();
    private static $query              = "";

    private function __construct(){}
    
    //public collection methods
    public static function collectData( $request )
    {
        //the database object
        $db = Database::openConnection();
        //the columns setup
        self::$columns = array(
            array(
                'db' => 'id',
                'dt' => 'DT_RowId',
                'formatter' => function( $d, $row ) {
                    return 'row_'.$d;
                }
            ),
            array(
                'db' => 'po_no',
                'dt' => 0,
                'formatter' => function( $d, $row ){
                        return '
                            <a href="/purchase-orders/view-update-purchase-order/po='.$row['id'].'">'.$d.'</a>'
                        ;
                }
            ),
            array(
                'db' => 'date',
                'dt' => 1,
                'formatter' => function($d, $row){
                    return date("d/m/Y", $d);
                }
            ),
            array(
                'db' => 'due_date',
                'dt' => 2,
                'formatter' => function($d, $row){
                    if (filter_var($d, FILTER_VALIDATE_INT))
                    {
                        return date("d/m/Y", $d);
                    }
                    else
                    {
                        return $d;
                    }
                }
            ),
            array(
                'db' => 'finisher_name',
                'dt' => 3,
                'formatter' => function($d, $row){
                    $details = "<p><span class='font-weight-bold'>$d</span>";
                    if(!empty($row['finisher_email'])) $details .= "<br>Email: ".$row['finisher_email'];
                    if(!empty($row['finisher_phone'])) $details .= "<br>Phone: ".$row['finisher_phone'];
                    $details .= "</p><p>";
                    if(!empty($row['contact_name'])) $details .= "Contact: ".$row['contact_name']."<br>";
                    if(!empty($row['contact_email'])) $details .= "Contact Email: ".$row['contact_email']."<br>";
                    if(!empty($row['contact_phone'])) $details .= "Contact Phone: ".$row['contact_phone']."<br>";
                    $details .= "</p>";
                    return $details;
                }
            ),
            array(
                'db' => 'job_number',
                'dt' => 4,
                'formatter' => function($d, $row){
                    if(!empty($d))
                        return $d;
                    return '';
                }
            ),
            array(
                'db' => 'quote_no',
                'dt' => 5,
                'formatter' => function($d, $row){
                    if(!empty($d))
                        return $d;
                    return '';
                }
            ),
            array(
                'db' => 'items',
                'dt'=> 6,
                'formatter' => function($d){
                    $items = explode("~", $d);
                    $item_string = "";
                    foreach($items as $i)
                    {
                        list($item_id, $qty, $description) = explode('|', $i);
                        $item_string .= "<div class='border-bottom border-secondary border-bottom-dashed mb-3 pb-2'>";
                        $item_string .= "<span class='font-weight-bold'>".strip_tags($description)."</span> - $qty";
                        $item_string .= "</div";
                    }
                    return $item_string;
                }
            ),
            array(
                'db' => '',
                'dt' => 7,
                'formatter' => function($row){
                    $location_string =  "";
                    return $location_string;
                }
            )
        );
        // Build the SQL query string from the request
        $limit = self::limit( $request );
        $order = self::order( $request, self::$columns, " ORDER BY id DESC ");
        $having = self::havingFilter( $request, self::$columns );
        
        $query = self::createQuery();
        $query .= " GROUP BY po.id ";
        // Total Data Set length
        $resTotalLength = $db->queryData($query);
        $recordsTotal = count($resTotalLength);
        // Filtering
        $query .= $having;
        // Data Set length after filtering
        $resFilterLength = $db->queryData($query, self::$db_array);
        $recordsFiltered = count($resFilterLength);
        // Order and limit for display
        $query .= $order;
        $query .= $limit;
        // Data for display
        $data = $db->queryData($query, self::$db_array);

        return array(
            "draw"            => isset ( $request['draw'] ) ?
                intval( $request['draw'] ) :
                0,
            "recordsTotal"    => intval( $recordsTotal ),
            "recordsFiltered" => intval( $recordsFiltered ),
            "data"            => self::dataOutput( self::$columns, $data )
        );
    }

    // Public Getters and Setters


    //private helper methods
    private static function createQuery()
    {
        return "
            SELECT
                po.*,
                pj.job_id AS job_number,
                pf.name AS finisher_name, pf.email AS finisher_email, pf.phone AS finisher_phone,
                pfc.name AS contact_name, pfc.email AS contact_email, pfc.phone AS contact_phone,
                GROUP_CONCAT(
                    IFNULL(poi.id,''),'|',
                    IFNULL(poi.qty,''),'|',
                    IFNULL(poi.description,'')
                    SEPARATOR '~'
                ) AS `items`
        ".self::from();
    }

    private static function from()
    {
        return "
            FROM
                `purchase_orders` po LEFT JOIN
                `purchase_order_items` poi ON po.id = poi.po_id LEFT JOIN
                `production_jobs` pj ON po.job_id = pj.id LEFT JOIN
                `production_finishers` pf ON po.finisher_id = pf.id LEFT JOIN
                `production_contacts` pfc ON po.contact_id = pfc.id
        ";
    }
 }
?>