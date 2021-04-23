<?php
$i = (isset($i))? $i : 0;
$this_item = $i + 1;
$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
if(isset($tpoia))
{
    $tpoid = "block";
    $poitem_id = $tpoia['item_id'];
}
else
{
    $tpoia = array(
        'qty'           => '',
        'description'   => '',
    );
    $tpoid = "none";
    $poitem_id = 0;
}
$poiqty = empty(Form::value('poitems['.$i.'][qty]'))?  $tpoia['qty'] : Form::value('poitems['.$i.'][qty]');
$poidescription = empty(Form::value('poitems['.$i.'][decription]'))?  $tpoia['description'] : Form::value('poitems['.$i.'][description]');
?>
<div id="poitem_<?php echo $i;?>" class="p-3 mid-grey mb-3 apoitem">
    <div class="form-group row">
        <h4 class="col-md-6 poitem_title">Item <?php echo ucwords($f->format($this_item));?>'s Details</h4>
        <div class="col-md-6">
            <h5><a data-poitem="<?php echo $i;?>" class="remove-poitem" style="cursor:pointer" title="Remove Item"><i class="fad fa-times-square text-danger"></i> Remove This Item</a></h5>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Quantity</label>
        <div class="col-md-8">
            <input type="text" class="form-control poitem_qty required" name="poitems[<?php echo $i;?>][qty]" value="<?php echo $poiqty;?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-12"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Description</label>
        <div class="col-md-12">
            <textarea class="ckeditor required" name="poitems[<?php echo $i;?>][description]" placeholder="Enter the item description"><?php echo $poidescription;?></textarea>
        </div>
    </div>
    <div class="this_poitem_hidden_details">
        <input type="hidden" name="poitems[<?php echo $i;?>][item_id]" value="<?php echo $poitem_id;?>">
    </div>
</div>