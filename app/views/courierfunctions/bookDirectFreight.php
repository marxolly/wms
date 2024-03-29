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
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <?php echo Form::displayError('general');?>
        <?php echo Form::displayError('df_error');?>
        <div id="feedback_holder" style="display:none;"></div>
        <?php if(isset($_SESSION['booking_id'])) :
            $booking_id = Session::getAndDestroy('booking_id');
            $booking = $this->controller->Dfbooking->getBookingById($booking_id);
            //echo "<pre>",print_r($booking),"</pre>"; ?>
            <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                <div class="row">
                    <div class="col">
                        <h3>Consignment Details</h3>
                    </div>
                </div>
                <div class="p-3 light-grey mb-3">
                    <div class="row">
                        <label class="col-5">Consignment ID:</label>
                        <div class="col-7"><?php echo $booking['consignment_id'];?></div>
                    </div>
                    <div class="row">
                        <label class="col-5">Direct Freight Label:</label>
                        <div class="col-7"><a href="<?php echo $booking['label_url'];?>" class="btn btn-outline-secondary" target="_blank">Download Label</a></div>
                    </div>
                    <div class="row">
                        <label class="col-5">Deliver To:</label>
                        <div class="col-7"><?php echo $booking['receiver_name'];?></div>
                    </div>
                    <div class="row">
                        <label class="col-5">Address:</label>
                        <div class="col-7"><?php echo $booking['address'];?></div>
                    </div>
                    <?php if(!empty($booking['address_2'])):?>
                        <div class="row">
                            <label class="col-5">&nbsp;</label>
                            <div class="col-7"><?php echo $booking['address_2'];?></div>
                        </div>
                    <?php endif;?>
                    <div class="row">
                        <label class="col-5">&nbsp;</label>
                        <div class="col-7"><?php echo $booking['suburb'];?></div>
                    </div>
                    <div class="row">
                        <label class="col-5">&nbsp;</label>
                        <div class="col-7"><?php echo $booking['state'];?></div>
                    </div>
                    <div class="row">
                        <label class="col-5">&nbsp;</label>
                        <div class="col-7"><?php echo $booking['postcode'];?></div>
                    </div>
                </div>
            </div>
            <div class="p-3 pb-0 mb-2 rounded-top form-section-holder">
                <div class="row">
                    <div class="col">
                        <h3>Costings</h3>
                        <p class="inst">These prices GST exclusive.</p>
                        <p class="inst">No margin has been added.</p>
                    </div>
                </div>
                <div class="p-3 light-grey mb-3">
                    <div class="row">
                        <label class="col-5">Freight Charge</label>
                        <div class="col-7"><?php echo "$".$booking['postage_charge'];?></div>
                    </div>
                    <div class="row">
                        <label class="col-5">Surcharges</label>
                        <div class="col-7"><?php echo "$".$booking['other_charges'];?></div>
                    </div>
                    <div class="row">
                        <label class="col-5">Fuel Levy</label>
                        <div class="col-7"><?php echo "$".$booking['fuel_levee'];?></div>
                    </div>
                    <div class="row">
                        <label class="col-5">Total Cost</label>
                        <div class="col-7"><?php echo "$".number_format(($booking['postage_charge'] + $booking['other_charges'] + $booking['fuel_levee']),2,'.',',');?></div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <form id="direct_freight_booker" method="post" action="/form/procBookDirectFreight">
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
                        <?php if(Form::$num_errors > 0 && is_array(Form::value('items'))):
                            //echo Form::displayError('items');
                            //echo "<pre>",print_r(Form::value('items')),"</pre>";
                            foreach(Form::value('items') as $i => $item):
                                //echo "<pre>",print_r($item),"</pre>";
                                $w = (isset($item['width']))? $item['width'] : 0 ;
                                $l = (isset($item['length']))? $item['length'] : 0 ;
                                $h = (isset($item['height']))? $item['height'] : 0 ;
                                $cw = (isset($item['weight']))? $item['weight'] : 0 ;
                                $cc = (isset($item['count']))? $item['count'] : 1 ;
                                $ip = (isset($item['pallet']))? true:false;
                                include(Config::get('VIEWS_PATH')."layout/page-includes/add_quote_package.php");
                            endforeach;?>
                        <?php else:?>
                            <?php include(Config::get('VIEWS_PATH')."layout/page-includes/add_quote_package.php");?>
                        <?php endif;?>
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
                            <label class="col-md-3 col-form-label">Contact Email</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control email" name="tracking_email" id="tracking_email" value="<?php echo Form::value('tracking_email');?>" />
                                <?php echo Form::displayError('tracking_email');?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Phone</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="contact_phone" id="contact_phone" value="<?php echo Form::value('contact_phone');?>" placeholder="Mobile Numbers Only" />
                                <?php echo Form::displayError('contact_phone');?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">FSG Reference</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="FSG_reference" id="FSG_reference" value="<?php echo Form::value('FSG_reference');?>" placeholder="Usually Our Job Number" />
                                <?php echo Form::displayError('FSG_reference');?>
                            </div>
                        </div>
                        <div class="form-group row custom-control custom-checkbox custom-control-right">
                            <input class="custom-control-input" type="checkbox" id="signature_req" name="signature_req" <?php if(!empty(Form::value('signature_req'))) echo 'checked';?> />
                            <label class="custom-control-label col-md-3" for="signature_req">Signature Required</label><br/>
                            <span class="inst">Leaving unchecked will give an 'Authority to Leave'</span>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Delivery Instructions</label>
                            <div class="col-md-4">
                                <textarea class="form-control" name="delivery_instructions" id="delivery_instructions" placeholder="Leave in a safe place out of the weather"><?php echo Form::value('delivery_instructions');?></textarea>
                                <span class="inst">Appears on shipping label. Defaults to 'Leave in a safe place out of the weather' for orders with an Authority To Leave</span>
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
                                <input type="hidden" name="courier_id" value="<?php echo $dfe_id;?>" />
                                <button type="submit" class="btn btn-outline-fsg" id="submitter">Book Shipment</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php endif;?>
    </div>
</div>