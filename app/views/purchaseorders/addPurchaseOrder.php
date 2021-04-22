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
                            The Items Go Here
                            <p>CKEditor 1</p>
                            <textarea name="content0" class="wysiwyg_editor" name="c0">This is some <strong>sample</strong> content.</textarea>
                            <p>CKEditor 2</p>
                            <textarea name="content1" class="wysiwyg_editor" name="c1">This is some <span class="font-italic">sample</span> content.</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>