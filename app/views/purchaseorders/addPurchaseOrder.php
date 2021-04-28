<?php

?>
<div id="page-wrapper">
    <div id="page_container" class="container-xl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <form id="add_purchase_order" method="post" action="/form/procAddPurchaseOrder">
            <div class="row">
<!------------------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------     Purchase Order Details     ---------------------------------------------------------->
<!------------------------------------------------------------------------------------------------------------------------------------------->
                <div class="col-sm-12 col-md-6 col-lg-5 mb-3" id="podetails">
                    <div class="card h-100 border-secondary po-card">
                        <div class="card-header bg-secondary text-white">
                            Purchase Order Details
                        </div>
                        <div class="card-body">
                            The Details Go Here
                        </div>
                    </div>
                </div>
<!------------------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------     Purchase Order Items     ------------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------------------------->
               <div class="col-sm-12 col-md-6 col-lg-7 mb-3" id="poitems">
                    <div class="card h-100 border-secondary po-card">
                        <div class="card-header bg-secondary text-white">
                            Purchase Order Items
                        </div>
                        <div class="card-body">
                            <div class="col">
                                <a class="add-poitem" style="cursor:pointer" title="Add An Item"><h4><i class="fad fa-plus-square text-success"></i> Add An Item</a></h4>
                            </div>
                            <div id="poitems_holder"></div>
                        </div>
                    </div>
                </div>
<!------------------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------     Form Submission     ---------------------------------------------------------------->
<!------------------------------------------------------------------------------------------------------------------------------------------->
                <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
                <div class="col-md-4 offset-6 offset-md-8">
                    <button type="submit" class="btn btn-lg btn-outline-secondary" id="submitter" disabled>Add This Purchase Order</button>
                </div>
            </div>
        </form>
    </div>
</div>