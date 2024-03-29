<?php
$address = Form::value('address');
$address2 = Form::value('address2');
$suburb = Form::value('suburb');
$state = Form::value('state');
$postcode = Form::value('postcode');
$country = !empty(Form::value('country'))?Form::value('country'):"AU";
$form_disabled = empty(Form::value('submitted'));
$idisp = "none";
if(!empty(Form::value('items')))
    $idisp = "block";
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <div id="feedback_holder" style="display:none;"></div>
        <form id="courier_booker" method="post" action="/form/procBookCourier">
            <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
               <div class="row">
                    <div class="col">
                        <h3>Courier</h3>
                    </div>
               </div>
               <div class="p-3 light-grey mb-3">
                   <div class="form-group row">
                        <label class="col-md-3">Name</label>
                        <div class="col-md-4">
                            <select id="courier_id" name="courier_id" class="form-control selectpicker" data-style="btn-outline-secondary">
                                <option value="0">--Select One--</option>
                                <option value="<?php echo $dfe_id;?>">Direct Freight Express</option>
                                <option value="<?php echo $ep_id;?>">Eparcel</option>
                                <option value="<?php echo $epe_id;?>">Eparcel Express</option>
                            </select>
                        </div>
                   </div>
               </div>
            </div>
            <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                <div class="row mb-0">
                    <div class="col-md-4">
                        <h3>Packages</h3>
                    </div>
                    <div class="col-md-4">
                        <a class="add-package" style="cursor:pointer" title="Add Another Package"><h4><i class="fad fa-plus-square text-success"></i> Add another</a></h4>
                    </div>
                    <div class="col-md-4">
                        <a id="remove-all-packages" style="cursor:pointer" title="Leave Only One"><h4><i class="fad fa-times-square text-danger"></i> Leave only one</a></h4>
                    </div>
                </div>
                <div id="packages_holder">
                    <?php include(Config::get('VIEWS_PATH')."layout/page-includes/add_quote_package.php");?>
                </div>
            </div>
            <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                <div class="row">
                    <div class="col">
                        <h3>Delivery Details</h3>
                    </div>
               </div>
               <div class="p-3 light-grey mb-3">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Deliver To</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control required" name="deliver_to" id="deliver_to" value="<?php echo Form::value('deliver_to');?>" />
                            <?php echo Form::displayError('deliver_to');?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Company Name</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="company_name" id="company_name" value="<?php echo Form::value('company_name');?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Tracking Email</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control email" name="tracking_email" id="tracking_email" value="<?php echo Form::value('tracking_email');?>" />
                            <span class="inst">Required if you wish to receive tracking notifications</span>
                            <?php echo Form::displayError('tracking_email');?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Phone</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="contact_phone" id="contact_phone" value="<?php echo Form::value('contact_phone');?>" />
                            <?php echo Form::displayError('contact_phone');?>
                        </div>
                    </div>
                   <?php include(Config::get('VIEWS_PATH')."forms/address_auonly.php");?>
               </div>
            </div>
            <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                <div class="row">
                    <div class="col">
                        <h3>Make Booking</h3>
                    </div>
               </div>
               <div class="p-3 light-grey mb-3">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <span class="inst">This will submit the details to the courier and book the shipment.<br>It cannot be altered or cancelled afterwards</span>
                        </div>
                        <div class="col-md-4 text-center text-md-left">
                            <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
                            <button type="submit" class="btn btn-outline-fsg" id="submitter">Book Courier</button>
                        </div>
                    </div>
               </div>
            </div>
        </form>
    </div>
</div>