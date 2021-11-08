<?php
//echo "FORM VALUES<pre>",print_r(Form::$values),"</pre>";
?>
<div class="row">
    <div class="col-12">
        <form id="pickup_search" method="post" action="/form/procPickupSearch">
            <div class="form-group row">
                <label class="col-md-2 col-sm-4">Search Term</label>
                <div class="col-md-6 col-sm-8">
                    <input type="text" class="form-control" name="term" id="term" value="<?php echo $term;?>" />
                    <span class="inst">Leave blank to get all pickups based on filter items below</span>
                    <?php echo Form::displayError('term');?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-lg-1 mb-3">Filter By Client</label>
                <div class="col-md-4 col-lg-3 mb-3">
                    <select id="client_id" name="client_id" class="form-control selectpicker" data-style="btn-outline-secondary" data-live-search="true"><option value="0">--Select One--</option><?php echo $this->controller->client->getSelectDeliveryClients($client_id);?></select>
                    <?php echo Form::displayError('client_id');?>
                </div>
                <label class="col-md-2 col-lg-1 mb-3">Filter By Status</label>
                <div class="col-md-4 col-lg-3 mb-3">
                    <select id="status_id" name="status_id" class="form-control selectpicker" data-style="btn-outline-secondary" data-live-search="true"><option value="0">--Select One--</option><?php echo $this->controller->pickup->getSelectStatus($status_id);?></select>
                </div>
                <label class="col-md-2 col-lg-1 mb-3">Filter By Urgency</label>
                <div class="col-md-4 col-lg-3 mb-3">
                    <select id="urgency_id" name="urgency_id" class="form-control selectpicker" data-style="btn-outline-secondary" data-live-search="true"><option value="0">--Select One--</option><?php echo $this->controller->deliveryurgency->getSelectAllUrgencies($urgency_id);?></select>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-md-3">Filter By Date Requested</label>
                <div class="col-md-1">
                    <label>From</label>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <input type="text" class="form-control" name="date_from" id="date_from" value="<?php echo $date_from;?>" />
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fad fa-calendar-alt"></i></span>
                        </div>

                    </div>
                </div>
                <div class="col-md-1">
                    <label>To</label>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <input type="text" class="form-control" name="date_to" id="date_to" value="<?php echo $date_to;?>" />
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fad fa-calendar-alt"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="date_from_value" name="date_from_value" value="<?php echo $date_from_value;?>" />
            <input type="hidden" id="date_to_value" name="date_to_value" value="<?php echo $date_to_value;?>" />
            <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
            <div class="form-group row">
                <div class="col-md-4 offset-md-8">
                    <button id="form_submitter" type="submit" class="btn btn-outline-fsg" disabled>Submit Search</button>
                </div>
            </div>
        </form>
    </div>
</div>

