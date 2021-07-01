<?php

?>
<div id="page-wrapper">
    <div id="page_container" class="container">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php"); ?>
        <div class="row mb-3">
            <label class="col-md-3">Select a Client</label>
            <div class="col-md-4">
                <select id="client_selector" class="form-control selectpicker" data-style="btn-outline-secondary" data-live-search="true"><option value="0">Select</option><?php echo $this->controller->client->getSelectClients($client_id);?></select>
            </div>
        </div>
        <?php if($client_id > 0):?>
            <div class="row">
                <div class="col-lg-12">
                    <h2>Inventory Comparing For <?php echo ucwords($client_name);?></h2>
                </div>
            </div>
        <?php endif;?>
    </div>
</div>
