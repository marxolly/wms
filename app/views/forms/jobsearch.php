<?php
$term       = (empty(Form::value('term')))? $term : Form::value('term');
$customer_id  = (empty(Form::value('customer_id')))? $customer_id : Form::value('customer_id');
$supplier_id  = (empty(Form::value('supplier_id')))? $supplier_id : Form::value('supplier_id');
$salesrep_id  = (empty(Form::value('salesrep_id')))? $salesrep_id : Form::value('salesrep_id');
$date_from_value  = (empty(Form::value('date_from_value')))? $date_from_value : Form::value('date_from_value');
$date_from = ($date_from_value > 0)? date("d/m/Y", $date_from_value) : "";
$date_to_value  = (empty(Form::value('date_to_value')))? $date_to_value : Form::value('date_to_value');
$date_to = ($date_to_value > 0)? date("d/m/Y", $date_to_value) : "";
?>
<div class="col-12">
    <form id="job_order_search" method="get" action="/jobs/job-search-results">
        <div class="form-group row">
            <label class="col-md-3">Search Term</label>
            <div class="col-md-4">
                <input type="text" class="form-control required" name="term" id="term" value="<?php echo $term;?>" />
                <span class="inst">Leave blank to get all orders based on filters below</span>
                <?php echo Form::displayError('term');?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3">Filter By Customer</label>
            <div class="col-md-4">
                <select id="customer_id" name="customer_id" class="form-control selectpicker" data-style="btn-outline-secondary" data-live-search="true"><option value="0">--Select One--</option><?php echo $this->controller->productioncustomer->getSelectCustomers($customer_id);?></select>
                <?php echo Form::displayError('client_id');?>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-md-3">Filter By Supplier</label>
            <div class="col-md-4">
                <select id="supplier_id" name="supplier_id" class="form-control selectpicker" data-style="btn-outline-secondary" data-live-search="true"><option value="0">--Select One--</option><?php echo $this->controller->productionsupplier->getSelectSuppliers($supplier_id);?></select>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-md-3">Filter By Sales Rep</label>
            <div class="col-md-4">
                <select id="salesrep_id" name="salesrep_id" class="form-control selectpicker" data-style="btn-outline-secondary" data-live-search="true"><option value="0">--Select One--</option><?php echo $this->controller->salesrep->getSelectSalesReps($salesrep_id);?></select>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-md-3">Filter By Status</label>
            <div class="col-md-4">
                <select id="status_id" name="status_id" class="form-control selectpicker" data-style="btn-outline-secondary" data-live-search="true"><option value="0">--Select One--</option><?php echo $this->controller->jobstatus->getSelectJobStatus($status_id);?></select>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-md-3">Filter By Date Entered</label>
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
            <label class="col-md-3">&nbsp;</label>
            <div class="col-md-4">
                <button type="submit" class="btn btn-outline-fsg">Submit Search</button>
            </div>
        </div>
    </form>
</div>