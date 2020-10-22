<?php
$date_filter = "Completed";
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/between_dates.php");?>
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="form-group">
                    <label>Filter By Driver</label>
                    <select id="driver_selector" class="form-control selectpicker" data-style="btn-outline-secondary" data-live-search="true"><option value="0">All Drivers</option><?php echo $this->controller->driver->getSelectDrivers($driver_id);?></select>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="form-group">
                    <label>Filter By Client</label>
                    <select id="client_selector" class="form-control selectpicker" data-style="btn-outline-secondary" data-live-search="true"><option value="0">All Clients</option><?php echo $this->controller->client->getSelectClients($client_id);?></select>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="form-group">
                    <label>Filter By Customer</label>
                    <select id="customer_selector" class="form-control selectpicker" data-style="btn-outline-secondary" data-live-search="true"><option value="0">All Customers</option><?php echo $this->controller->productioncustomer->getSelectCustomers($customer_id);?></select>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="form-group">
                    <label style="width:100%">&nbsp;</label>
                    <button id="csv_download" class="btn btn-outline-success"><i class="far fa-file-alt"></i>&nbsp;Download As CSV</button>
                </div>
            </div>
        </div>
        <?php if(count($runsheets)):?>
            <?php echo "<pre>",print_r($runsheets),"</pre>";?>
        <?php else:?>
            <div class="row">
                <div class="col-12">
                    <div class="errorbox">
                        <h2><i class="fas fa-exclamation-triangle"></i> No Completed Runsheets Listed</h2>
                        <p>Either there are no completed runsheets or you need to remove some filters</p>
                    </div>
                </div>
            </div>
        <?php endif;?>
    </div>
</div>