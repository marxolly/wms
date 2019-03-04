<?php
$i = 0;
?>
<?php foreach($parts as $name => $details):
    $part_name = ucwords(str_replace("_", " ", $name));
    ?>
    <div class="form-group row">
        <label class="col-md-3 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> <?php echo $part_name;?></label>
        <div class="col-md-1"><input type="text" name="items[<?php echo $i;?>][qty]" class="form-control required number" value="<?php echo $details['qty'];?>" /></div>
        <input type="hidden" name="items[<?php echo $i;?>][id]" value="<?php echo $details['id'];?>" />
    </div>
<?php ++$i; endforeach;?>
<div class="row">
    <div class="col-lg-12">
        <h4>Additional Items</h4>
    </div>
</div>