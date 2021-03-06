<?php
$i = (isset($i))? $i : 0;
$this_finisher = $i + 1;
$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
if(isset($tfa))
{
    $tfd = "block";
    $finisher_id = isset($tfa['id'])? $tfa['id']: $tfa['finisher_id'];
}
else
{
    $tfa = array(
        'name'              => '',
        'purchase_order'    => '',
        'ed_date_value'     => '',
        'address'           => '',
        'address_2'         => '',
        'suburb'            => '',
        'state'             => '',
        'postcode'          => '',
        'contact_id'        => 0,
        'country'           => 'AU'
    );
    $tfd = "none";
    $finisher_id = 0;
}

$fname = empty(Form::value('finishers['.$i.'][name]'))?  $tfa['name'] : Form::value('finishers['.$i.'][name]');
$fpo = empty(Form::value('finishers['.$i.'][purchase_order]'))?  $tfa['purchase_order'] : Form::value('finishers['.$i.'][purchase_order]');
$fed_date_value = empty(Form::value('finishers['.$i.'][ed_date_value]'))?  $tfa['ed_date_value'] : Form::value('finishers['.$i.'][ed_date_value]');
$faddress = empty(Form::value('finishers['.$i.'][address]'))?  $tfa['address'] : Form::value('finishers['.$i.'][address]');
$faddress_2 = empty(Form::value('finishers['.$i.'][address_2]'))?  $tfa['address_2'] : Form::value('finishers['.$i.'][address_2]');
$fsuburb = empty(Form::value('finishers['.$i.'][suburb]'))?  $tfa['suburb'] : Form::value('finishers['.$i.'][suburb]');
$fstate = empty(Form::value('finishers['.$i.'][state]'))?  $tfa['state'] : Form::value('finishers['.$i.'][state]');
$fpostcode = empty(Form::value('finishers['.$i.'][postcode]'))?  $tfa['postcode'] : Form::value('finishers['.$i.'][postcode]');
$fcountry = empty(Form::value('finishers['.$i.'][country]'))?  $tfa['country'] : Form::value('finishers['.$i.'][country]');
$fcontact_id = empty(Form::value('finishers['.$i.'][contact_id]'))?  $tfa['contact_id'] : Form::value('finishers['.$i.'][contact_id]');
?>
<div id="finisher_<?php echo $i;?>" class="p-3 mid-grey mb-3 afinisher">
    <div class="form-group row">
        <h4 class="col-md-6 finisher_title">Finisher <?php echo ucwords($f->format($this_finisher));?>'s Details</h4>
        <div class="col-md-6">
            <h5><a data-finisher="<?php echo $i;?>" class="remove-finisher" style="cursor:pointer" title="Remove Finisher"><i class="fad fa-times-square text-danger"></i> Remove This Finisher</a></h5>
        </div>
    </div>
    <div class="form-group row">
        <?php if( !empty($tfa['name'])):?>
            <label class="col-md-4"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Finisher Name</label>
            <div class="col-md-8">
                <input type="text" class="form-control finisher_name no-autocomplete" data-finisher="<?php echo $i;?>" name="finishers[<?php echo $i;?>][name]" value="<?php echo $fname;?>">
                <?php echo Form::displayError('finishername_'.$i);?>
            </div>
        <?php else:?>
            <label class="col-md-4"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Finisher Name</label>
            <div class="col-md-8">
                <input type="text" class="form-control finisher_name" data-finisher="<?php echo $i;?>" name="finishers[<?php echo $i;?>][name]" value="<?php echo $fname;?>">
                <span class="inst">
                    Start typing a name and choose a finisher from the list<br>
                    Only finishers already in the system can be chosen here<br>
                    <a href="/finishers/add-finisher" target="_blank" title="opens in new window">Click here to add a new finisher <i class="fal fa-external-link"></i></a>
                </span>
                <?php echo Form::displayError('finishername_'.$i);?>
            </div>
        <?php endif;?>
    </div>
    <div class="this_finisher_details" style="display:<?php echo $tfd;?>;">
        <div class="form-group row custom-control custom-checkbox custom-control-right">
            <input class="custom-control-input send_to_address send_to_finisher" data-finisher="<?php echo $i;?>" type="checkbox" id="send_to_finisher_<?php echo $i;?>" name="send_to_finisher_<?php echo $i;?>" />
            <label class="custom-control-label col-md-7 send_to_finisher" for="send_to_finisher_<?php echo $i;?>">Send Job To This Finisher</label>
        </div>
        <div id="contact_selector_<?php echo $i;?>" class="form-group row contact_selector">
            <?php if($finisher_id > 0)
            {
                $finisher_index = $i;
                include(Config::get('VIEWS_PATH')."layout/page-includes/finisher_contact_selector.php");
            }?>
        </div>
        <div class="form-group row">
            <label class="col-md-4">Purchase Order Number</label>
            <div class="col-md-8">
                <input type="text" class="form-control finisher_po" name="finishers[<?php echo $i;?>][purchase_order]" value="<?php echo $fpo;?>">
            </div>
        </div>
        <div class="row form-group">
            <label class="col-md-4 col-form-label">Expected Delivery Date</label>
            <div class="col-md-8">
                <div class="input-group">
                    <input type="text" class="form-control finisher_ed_date" name="finishers[<?php echo $i;?>][ed_date]" value="<?php if(!empty($fed_date_value)) echo date('d/m/Y', $fed_date_value);?>">
                    <div class="input-group-append">
                        <span class="input-group-text calendar_icon"><i class="fad fa-calendar-alt"></i></span>
                    </div>
                </div>
            </div>
            <input type="hidden" class="finisher_ed_date_value" name="finishers[<?php echo $i;?>][ed_date_value]" value="<?php echo $fed_date_value;?>">
        </div>
    </div>
    <div class="this_finisher_hidden_details">
        <input type="hidden" class="finisher_id" name="finishers[<?php echo $i;?>][finisher_id]" value="<?php echo $finisher_id;?>">
        <input type="hidden" class="finisher_address" name="finishers[<?php echo $i;?>][address]" value="<?php echo $faddress;?>">
        <input type="hidden" class="finisher_address_2" name="finishers[<?php echo $i;?>][address_2]" value="<?php echo $faddress_2;?>">
        <input type="hidden" class="finisher_suburb" name="finishers[<?php echo $i;?>][suburb]" value="<?php echo $fsuburb;?>">
        <input type="hidden" class="finisher_state" name="finishers[<?php echo $i;?>][state]" value="<?php echo $fstate;?>">
        <input type="hidden" class="finisher_postcode" name="finishers[<?php echo $i;?>][postcode]" value="<?php echo $fpostcode;?>">
        <input type="hidden" class="finisher_country" name="finishers[<?php echo $i;?>][country]" value="<?php echo $fcountry;?>">
    </div>
</div>