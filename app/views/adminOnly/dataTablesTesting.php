<?php

?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <input type="hidden" id="client_id" value="<?php echo $client_id;?>" />
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php"); ?>
        <div class="row mb-3">
            <label class="col-md-3">Select a Client</label>
            <div class="col-md-4">
                <select id="client_selector" class="form-control selectpicker" data-style="btn-outline-secondary" data-live-search="true"><option value="0">Select</option><?php echo $this->controller->client->getSelectClients($client_id);?></select>
            </div>
        </div>
        <?php if($client_id > 0):?>
            <div class="row">
                <div class="col">
                    <?php //echo "<pre>",print_r($products),"</pre>";?>
                    <?php echo "Client ID: ".ViewInventory::getClientId();?>
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
        <?php endif;?>
    </div>
</div>
