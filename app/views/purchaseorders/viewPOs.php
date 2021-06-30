<?php

?>
<div id="page-wrapper">
    <div id="page_container" class="container-xl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php"); ?>
        <div id="waiting" class="row">
            <div class="col-lg-12 text-center">
                <h2>Drawing Table..</h2>
                <p>May take a few moments</p>
                <img class='loading' src='/images/preloader.gif' alt='loading...' />
            </div>
        </div>
        <div class="row" id="table_holder" style="display:none">
            <div class="col-md-12">
                <table class="table-striped table-hover" id="view_purchase_orders_table" width="100%">
                    <thead>
                        <tr>
                            <th data-priority="1">PO Number</th>
                            <th>Date Created</th>
                            <th data-priority="1">Date Required</th>
                            <th data-priority="1">Finisher</th>
                            <th data-priority="2">Job</th>
                            <th data-priority="4">Quote</th>
                            <th data-priority="1">Items</th>
                            <th data-priority="1"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>