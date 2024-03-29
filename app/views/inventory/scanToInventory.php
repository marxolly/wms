<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <input type="hidden" id="client_id" value="<?php echo $client_id;?>" />
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <?php if($can_change_client):?>
            <div class="row mb-3">
                <label class="col-md-3">Select a Client</label>
                <div class="col-md-4">
                    <select id="client_selector" class="form-control selectpicker" data-style="btn-outline-secondary" data-live-search="true"><option value="0">Select</option><?php echo $this->controller->client->getSelectClients($client_id);?></select>
                </div>
            </div>
        <?php else:?>
            <div class="row mb-3">
                <label class="col-md-3">Client</label>
                <div class="col-md-4">
                    <input type="text" readonly class="form-control" value="<?php echo $client_name;?>" >
                    <input type="hidden" id="client_selector" value="<?php echo $client_id;?>" >
                </div>
            </div>
        <?php endif;?>
        <?php if($client_id > 0):?>
            <div class="row">
                <div class="col-lg-12">
                    <?php if(isset($_SESSION['feedback'])) :?>
                       <div class='feedbackbox'><i class="far fa-check-circle"></i> <?php echo Session::getAndDestroy('feedback');?></div>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['errorfeedback'])) :?>
                       <div class='errorbox'><i class="far fa-times-circle"></i> <?php echo Session::getAndDestroy('errorfeedback');?></div>
                    <?php endif; ?>
                </div>
            </div>
            <!--div class="form-group row">
                <label class="col-md-3 col-form-label">Item Name</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="item_name" id="item_name" placeholder="search by name" />
                </div>
            </div-->
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Item Barcode</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="item_barcode" id="item_barcode" placeholder="scan the barcode or manually type it in" />
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary btn-sm" id="get_item">Locate Item</button>
                </div>
            </div>
            <div id="item_details" class="container-fluid"></div>
        <?php endif;?>
    </div>
</div>