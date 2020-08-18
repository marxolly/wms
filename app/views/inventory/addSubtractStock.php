<div id="page-wrapper">
    <div id="page_container" class="container-xl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <div class="row">
            <div class="col">
                <p><a class="btn btn-outline-fsg" href="/inventory/view-inventory/client=<?php echo $product_info['client_id'];?>">Clieny Inventory</a></p>
            </div>
            <div class="col text-right">
                <p><a class="btn btn-outline-fsg" href="/inventory/move-stock/product=<?php echo $product_id;?>">Move Stock</a></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-4 mb-3">
                <div class="card h-100 border-secondary">
                    <div class="card-header bg-secondary text-white">
                        Current Locations
                    </div>
                    The locations list will go in this box
                </div>
            </div>
            <div class="col-sm-9 col-md-9 col-lg-9 col-xl-4 mb-3">
                <div class="card h-100 border-secondary">
                    <div class="card-header bg-secondary text-white">
                        Add To Stock
                    </div>
                        <form id="add_to_stock" method="post" action="/form/procAddToStock">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Quantity</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control required number" name="qty_add" id="qty_add" value="<?php echo Form::value('qty_add');?>" />
                                    <?php echo Form::displayError('qty_add');?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-check">
                                    <label class="form-check-label col-md-5" for="under_qc">Under Quality Control</label>
                                    <div class="col-md-7 checkbox checkbox-default">
                                        <input class="form-check-input styled" type="checkbox" id="under_qc" name="under_qc" <?php if(!empty(Form::value('under_qc'))) echo 'checked';?> />
                                        <label for="under_qc"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-5"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Location</label>
                                <div class="col-md-7">
                                    <select id="add_to_location" name="add_to_location" class="form-control selectpicker" data-live-search="true"><option value="0">--Select One--</option>
                                        <?php echo $this->controller->location->getSelectLocations(Form::value('add_to_location'), $item_id);?>
                                    </select>
                                    <?php echo Form::displayError('add_to_location');?>
                                </div>
                            </div>
                            <div class="form-group row form-check">
                                <label class="col-md-5" for="to_receiving">Add To Receiving</label>
                                <div class="col-md-7" checkbox checkbox-default>
                                    <input class="form-check-input styled" type="checkbox" id="to_receiving" name="to_receiving" <?php if(!empty(Form::value('to_receiving'))) echo 'checked';?> />
                                    <label for="to_receiving"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Reason</label>
                                <div class="col-md-7">
                                    <select id="reason_id" name="reason_id" class="form-control selectpicker" data-live-search="true"><option value="0">--Select One--</option><?php echo $this->controller->stockmovementlabels->getSelectStockMovementLabels(Form::value('reason_id'));?></select>
                                    <?php echo Form::displayError('reason_id');?>
                                </div>
                            </div>
                            <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
                            <input type="hidden" name="add_product_id" value="<?php echo $product_id; ?>" />
                            <input type="hidden" name="client_id" value="<?php echo $product_info['client_id']; ?>" />
                            <input type="hidden" name="add_product_name" value="<?php echo $product_info['name']; ?>" />
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">&nbsp;</label>
                                <div class="col-md-7">
                                    <button type="submit" class="btn btn-primary">Add To Stock</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
            <div class="col-sm-9 col-md-9 col-lg-9 col-xl-4 ml-auto mb-3">
                <div class="card h-100 border-secondary">
                    <div class="card-header bg-secondary text-white">
                        Subtract From Stock
                    </div>
                    The subtract from stock form goes in this box
                </div>
            </div>
        </div>
    </div>
</div>