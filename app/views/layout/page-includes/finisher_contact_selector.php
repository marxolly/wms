<?php
$contact_id = (isset($contact_id))? $contact_id : 0;
?>
<label class="col-md-4">Finisher Contact</label>
<div class="col-md-8">
    <select  class="form-control selectpicker finisher_contact_id" data-style="btn-outline-secondary" name="finishers[<?php echo $finisher_index;?>][contact_id]"><option value="0">Choose One</option><?php echo $this->controller->productionfinisher->getSelectFinisherContacts($finisher_id, $contact_id);?></select>
</div>