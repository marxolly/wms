<?php

?>
<div id="page-wrapper">
    <div id="page_container" class="container-xl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php"); ?>
        <div class="row">
            <div class="col">
                <?php //echo "<pre>",print_r($products),"</pre>";?>
                <?php echo "Client ID: ".ViewInventory::getClientId();?>
                <?php echo ViewInventory::collectData(array(
                    'start' => 0,
                    'length'    => 25,
                    'search'    => array(
                        'value' => 'Jesus'
                    ),
                    'columns' => array(
                        array( 'db' => 'name', 'dt' => 0 ),
                        array( 'db' => 'sku',  'dt' => 1 ),
                        array( 'db' => 'barcode',   'dt' => 2 ),
                        array( 'db' => 'client_product_id', 'dt' => 3 ),
                        array( 'db' => 'on_hand', 'dt' => 4 ),
                        array( 'db' => 'allocated', 'dt'=> 5),
                        array( 'db' => 'qc_count', 'dt'=> 6),
                        array( 'db' => 'available', 'dt'=> 7),
                        array( 'db' => 'locations', 'dt'=> 8),
                        array( 'db' => '', 'dt' => 9)
                    )
                ));?>
            </div>
        </div>
        <div id="waiting" class="row">
            <div class="col-lg-12 text-center">
                <h2>Drawing Table..</h2>
                <p>May take a few moments</p>
                <img class='loading' src='/images/preloader.gif' alt='loading...' />
            </div>
        </div>
        <div class="row" id="table_holder" style="display:none">
            <div class="col-md-12">
                <table class="table-striped table-hover" id="view_items_table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>SKU</th>
                            <th>Barcode</th>
                            <th>Client Product ID</th>
                            <th>On Hand</th>
                            <th>Allocated</th>
                            <th>Under Quality Control</th>
                            <th>Available</th>
                            <th>Locations</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
