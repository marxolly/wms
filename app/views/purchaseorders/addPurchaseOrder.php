<?php
$finisher_id = (empty(Form::value('finisher_id')))? 0 : Form::value('finisher_id');
$date = (empty(Form::value('date_value')))? time() : Form::value('date_value');
if( empty(Form::value('required_date')) )
{
    $required_date_value = $required_date = "";
}
else
{
    if (filter_var(Form::value('required_date_value'), FILTER_VALIDATE_INT))
    {
        $required_date_value = Form::value('required_date_value');
        $required_date = date('d/m/Y', $required_date_value);
    }
    else
    {
        $required_date_value = '';
        $required_date = Form::value('required_date');
    }
}
$dd = ( empty(Form::value('finisher_id')) )? "none":"block";
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <?php echo "<pre>FORM VALUES",print_r(Form::$values),"</pre>"; ?>
        <form id="add_purchase_order" method="post" action="/form/procAddPurchaseOrder">
            <div class="row">
<!------------------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------     Purchase Order Details     ---------------------------------------------------------->
<!------------------------------------------------------------------------------------------------------------------------------------------->
                <div class="col-sm-12 col-md-6 col-lg-5 mb-3" id="podetails">
                    <div class="card h-100 border-secondary po-card">
                        <div class="card-header bg-secondary text-white">
                            Purchase Order Details
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-12"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Finisher/Supplier Name</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control finisher_name required" name="finisher_name" id="finisher_name" value="<?php echo Form::value('finisher_name');?>">
                                    <span class="inst">
                                        Start typing a name and choose a finisher/supplier from the list<br>
                                        Only finishers/suppliers already in the system can be chosen here<br>
                                        <a href="/finishers/add-finisher" target="_blank" title="opens in new window">Click here to add a new finisher/supplier <i class="fal fa-external-link"></i></a>
                                    </span>
                                    <?php echo Form::displayError('finisher_name');?>
                                </div>
                            </div>
                            <div id="podetails_holder" style="display:<?php echo $dd;?>">
                                <div id="contact_selector" class="form-group row contact_selector">
                                    <?php if($finisher_id > 0)
                                    {
                                        include(Config::get('VIEWS_PATH')."layout/page-includes/po_finisher_contact_selector.php");
                                    }?>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-12"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Purchase Order Date</label>
                                    <div class="col-md-12 input-group">
                                        <input type="text" class="required form-control" name="date" id="date" value="<?php echo date('d/m/Y', $date);?>" />
                                        <div class="input-group-append">
                                            <span id="date_calendar" class="input-group-text"><i class="fad fa-calendar-alt"></i></span>
                                        </div>
                                    </div>
                                    <?php echo Form::displayError('date');?>
                                    <input type="hidden" name="date_value" id="date_value" value="<?php echo $date;?>" />
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-12"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Required</label>
                                    <div class="col-md-12 input-group">
                                        <input type="text" class="required form-control" name="required_date" id="required_date" value="<?php echo $required_date;?>" />
                                        <div class="input-group-append">
                                            <span id="required_date_calendar" class="input-group-text"><i class="fad fa-calendar-alt"></i></span>
                                        </div>
                                    </div>
                                    <?php echo Form::displayError('required_date');?>
                                    <input type="hidden" name="required_date_value" id="required_date_value" value="<?php echo $required_date_value;?>" />
                                </div>
                                <div class="form-group row">
                                    <label class="col-12">FSG Job No</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="fsg_job_no" name="fsg_job_no" value="<?php echo Form::value('fsg_job_no');?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12">FSG Quote No</label>
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="fsg_quote_no" name="fsg_quote_no" value="<?php echo Form::value('fsg_quote_no');?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!------------------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------     Purchase Order Items     ------------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------------------------->
               <div class="col-sm-12 col-md-6 col-lg-7 mb-3" id="poitems">
                    <div class="card h-100 border-secondary po-card">
                        <div class="card-header bg-secondary text-white">
                            Purchase Order Items
                        </div>
                        <div class="card-body">
                            <div class="col">
                                <a class="add-poitem" style="cursor:pointer" title="Add An Item"><h4><i class="fad fa-plus-square text-success"></i> Add An Item</a></h4>
                            </div>
                            <div id="poitems_holder">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <span class="inst">At least one item is required</span>
                                    </div>
                                    <?php echo Form::displayError('items');?>
                                </div>
                                <?php if(!empty(Form::value('poitems'))):
                                    foreach(Form::value('poitems') as $i => $d)
                                    {
                                        include(Config::get('VIEWS_PATH')."layout/page-includes/add_poitem.php");
                                    }
                                endif;?>
                            </div>
                        </div>
                    </div>
                </div>
<!------------------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------     Form Submission     ---------------------------------------------------------------->
<!------------------------------------------------------------------------------------------------------------------------------------------->
                <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
                <input type="hidden" name="finisher_id" id="finisher_id" value="<?php echo $finisher_id;?>" />
                <div class="col-md-4 offset-6 offset-md-8">
                    <button type="submit" class="btn btn-lg btn-outline-secondary" id="submitter">Add This Purchase Order</button>
                </div>
            </div>
        </form>
    </div>
</div>