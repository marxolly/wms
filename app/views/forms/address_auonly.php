<div class="form-group row">
    <label class="col-md-3"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Address Line 1</label>
    <div class="col-md-4">
        <input type="text" class="form-control required" name="address" id="address" value="<?php echo $address;?>" />
        <?php echo Form::displayError('address');?>
    </div>
    <div class="custom-control custom-checkbox col-md-3">
        <input type="checkbox" class="custom-control-input" id="ignore_address_error" name="ignore_address_error" <?php if(!empty(Form::value('ignore_address_error'))) echo 'checked';?> />
        <label class="custom-control-label" for="ignore_address_error">No need for a number</label>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3">Address Line 2</label>
    <div class="col-md-4">
        <input type="text" class="form-control" name="address2" id="address2" value="<?php echo $address2;?>" />
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Suburb/Town</label>
    <div class="col-md-4">
        <input type="text" class="form-control required" name="suburb" id="suburb" value="<?php echo $suburb;?>" />
        <?php echo Form::displayError('suburb');?>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> State</label>
    <div class="col-md-4">
        <select id="state" name="state" class="form-control selectpicker" data-style="btn-outline-secondary" required><option value="0">--Select One--</option><?php echo Utility::getStateSelect($state);?></select>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 "><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Postcode</label>
    <div class="col-md-4">
        <input type="text" class="form-control required" name="postcode" id="postcode" value="<?php echo $postcode;?>" />
        <?php echo Form::displayError('postcode');?>
    </div>
</div>
<input type="hidden" id="country" name="country" value = "AU">