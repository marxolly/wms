<?php
$i = (isset($i))? $i : 0;
$this_address = $i + 1;
$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);

?>
<div id="address_<?php echo $i;?>" class="p-3 mid-grey mb-3 anaddress">
    <div class="form-group row">
        <h4 class="col-md-6 address_title">Delivery Address <?php echo ucwords($f->format($this_address));?>'s Details</h4>
        <div class="col-md-6">
            <h5><a data-address="<?php echo $i;?>" class="remove-address" style="cursor:pointer" title="Remove Address"><i class="fad fa-times-square text-danger"></i> Remove This Address</a></h5>
        </div>
    </div>
</div>