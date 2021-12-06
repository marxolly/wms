<?php
$items = explode("~",$dd['items']);
?>
<div class="page-wrapper">
    <div class="row" id="feedback_holder" style="display:none"></div>
    <form id="adjust-allocation" method="post" action="/form/procAdjustDeliveryAllocations">
        <?php foreach($items as $i):
            list($item_id, $item_name, $item_sku, $item_qty, $location_id, $line_id) = explode("|",$i);?>
            <div class="form-group row">
                <label class="col-10 offset-1 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Locations With <?php echo $item_qty;?> of <?php echo $item_name." (".$item_sku.")";?></label>
                <div class="col-12">
                    <select  name="allocation[<?php echo $line_id;?>][location_id]" class="form-control selectpicker" data-live-search="true" required><option value="">--Select One--</option><?php echo $this->controller->location->getSelectLocationsForDeliveryItem($item_id, $item_qty, $location_id);?></select>
                </div>
            </div>
        <?php endforeach;?>
        <input type="hidden" name="delivery_id" value="<?php echo $dd['id'];?>">
        <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
        <div class="form-group row">
            <div class="col-md-4 offset-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>