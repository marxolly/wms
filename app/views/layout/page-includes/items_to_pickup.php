<?php
if(!isset($i)) $i = 1;
?>
<div id="pickup_item_<?php echo $i;?>" class="pickup_item row">
    <div class="col-11 offset-1 font-weight-bold"><?php echo $label;?></div>
    <div class="form-group row">
        <div class="col-5 col-form-label">Pallets To Collect</div>
        <div class="col-3">
            <input type="text" class="form-control required number pickupcount" data-rule-number="true" name="pickup_items[<?php echo $item_id;?>]" >
        </div>
        <div class="col-4 text-right">
            <button class="btn btn-sm btn-danger remove-pickup-item" data-rowid="<?php echo $i;?>"><i class="fal fa-times-circle"></i> Remove</button>
        </div>
    </div>
</div>