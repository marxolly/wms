<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <input type="hidden" id="client_id" value="<?php echo $client_id;?>" />
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <div class="row">
            <div class="col-lg-12">
                <h2>Collections for <?php echo $client_name;?></h2>
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
                <table class="table-striped table-hover" id="client_collection_table" width="100%">
                    <thead>
                        <tr>
                            <th data-priority="1">Collection Item</th>
                            <th>SKU</th>
                            <th>Client Product Id</th>
                            <th>Items In Collection</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>