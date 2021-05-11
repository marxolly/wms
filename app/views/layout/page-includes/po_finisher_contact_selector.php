<?php
$contact_id = (empty(Form::value('finisher_contact_id')))? 0 : Form::value('finisher_contact_id');
?>
<label class="col-md-4">Contact</label>
<div class="col-md-8">
    <select  class="form-control selectpicker finisher_contact_id" data-style="btn-outline-secondary" name="finisher_contact_id"><option value="0">Choose One</option><?php echo $this->controller->productionfinisher->getSelectFinisherContacts($finisher_id, $contact_id);?></select>
</div>