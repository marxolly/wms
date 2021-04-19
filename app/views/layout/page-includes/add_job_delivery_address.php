<?php
$i = (isset($i))? $i : 0;
$this_address = $i + 1;
$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);



if(isset($taa))
{
    $tad = "block";
    $address_id = $taa['id'];
}
else
{
    $taa = array(
        'shipto'                => '',
        'attention'             => '',
        'delivery_instructions' => '',
        'address'               => '',
        'address_2'             => '',
        'suburb'                => '',
        'state'                 => '',
        'postcode'              => '',
        'country'               => 'AU'
    );
    $tad = "none";
    $address_id = 0;
}

$shipto = empty(Form::value('addresses['.$i.'][shipto]'))?  $taa['shipto'] : Form::value('addresses['.$i.'][shipto]');
$attention = empty(Form::value('addresses['.$i.'][attention]'))?  $taa['attention'] : Form::value('addresses['.$i.'][attention]');
$delivery_instructions = empty(Form::value('addresses['.$i.'][delivery_instructions]'))?  $taa['delivery_instructions'] : Form::value('addresses['.$i.'][delivery_instructions]');
$daddress = empty(Form::value('addresses['.$i.'][address]'))?  $taa['address'] : Form::value('addresses['.$i.'][address]');
$daddress_2 = empty(Form::value('addresses['.$i.'][address_2]'))?  $taa['address_2'] : Form::value('addresses['.$i.'][address_2]');
$dsuburb = empty(Form::value('addresses['.$i.'][suburb]'))?  $taa['suburb'] : Form::value('addresses['.$i.'][suburb]');
$dstate = empty(Form::value('addresses['.$i.'][state]'))?  $taa['state'] : Form::value('addresses['.$i.'][state]');
$dpostcode = empty(Form::value('addresses['.$i.'][postcode]'))?  $taa['postcode'] : Form::value('addresses['.$i.'][postcode]');
$dcountry = empty(Form::value('addresses['.$i.'][country]'))?  $taa['country'] : Form::value('addresses['.$i.'][country]');








?>
<div id="address_<?php echo $i;?>" class="p-3 mid-grey mb-3 anaddress">
    <div class="form-group row">
        <h4 class="col-md-6 address_title">Delivery Address <?php echo ucwords($f->format($this_address));?>'s Details</h4>
        <div class="col-md-6">
            <h5><a data-address="<?php echo $i;?>" class="remove-address" style="cursor:pointer" title="Remove Address"><i class="fad fa-times-square text-danger"></i> Remove This Address</a></h5>
        </div>
    </div>
    <div class="form-group row custom-control custom-checkbox custom-control-right">
        <input class="custom-control-input send_to_address send_to_customer" type="checkbox" id="send_to_customer_<?php echo $i;?>" data-address="<?php echo $i;?>" name="send_to_customer" />
        <label class="custom-control-label col-md-7" for="send_to_customer_<?php echo $i;?>">Use Customer's Address</label>
    </div>
    <div id="deliver_to_finisher_checkbox_holder_<?php echo $i;?>"></div>


    <div class="form-group row">
        <label class="col-md-4 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Deliver To</label>
        <div class="col-md-8">
            <input type="text" class="form-control required" name="addresses[<?php echo $i;?>][shipto]" id="shipto_<?php echo $i;?>" value="<?php echo $shipto;?>" />
            <?php echo Form::displayError('shipto_'.$i);?>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4 col-form-label">Attention</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="addresses[<?php echo $i;?>][attention]" id="attention_<?php echo $i;?>" value="<?php echo $attention;?>" />
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4 col-form-label">Delivery Instructions</label>
        <div class="col-md-8">
            <textarea class="form-control" name="addresses[<?php echo $i;?>][delivery_instructions]" id="deliveryinstructions_<?php echo $i;?>" placeholder="Instructions For Driver"><?php echo $delivery_instructions;?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Address Line 1</label>
        <div class="col-md-8">
            <input type="text" class="form-control required" name="addresses[<?php echo $i;?>][address]" id="address_<?php echo $i;?>" value="<?php echo $daddress;?>" />
            <?php echo Form::displayError('address_'.$i);?>
        </div>
        <div class="custom-control custom-checkbox col-md-7 offset-md-5">
            <input type="checkbox" class="custom-control-input" id="ignore_address_error" name="ignore_address_error" <?php if(!empty(Form::value('ignore_address_error'))) echo 'checked';?> />
            <label class="custom-control-label" for="ignore_address_error">No need for a number</label>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4">Address Line 2</label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="addresses[<?php echo $i;?>][address_2]" id="address2_<?php echo $i;?>" value="<?php echo $daddress_2;?>" />
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Suburb/Town</label>
        <div class="col-md-8">
            <input type="text" class="form-control required" name="addresses[<?php echo $i;?>][suburb]" id="suburb_<?php echo $i;?>" value="<?php echo $dsuburb;?>" />
            <?php echo Form::displayError('suburb_'.$i);?>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> State</label>
        <div class="col-md-8">
            <input type="text" class="form-control required" name="addresses[<?php echo $i;?>][state]" id="state_<?php echo $i;?>" value="<?php echo $dstate;?>" />
            <span class="inst">Use VIC, NSW, QLD, ACT, TAS, WA, SA, NT only</span>
            <?php echo Form::displayError('state');?>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4 "><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Postcode</label>
        <div class="col-md-8">
            <input type="text" class="form-control required" name="addresses[<?php echo $i;?>][postcode]" id="postcode_<?php echo $i;?>" value="<?php echo $dpostcode;?>" />
            <?php echo Form::displayError('postcode');?>
        </div>
    </div>
    <input type="hidden" name="addresses[<?php echo $i;?>][country]" value = "AU">



</div>