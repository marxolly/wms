<?php
$pickup_id = $pickup['id'];
$client_id = $pickup['client_id'];
$items = explode("~",$pickup['items']);
$cover_class = (!empty($pickup['vehicle_type']))? "" : "covered";
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <?php //echo "<pre>",print_r($pickup),"</pre>";?>
        <div class="row">
            <div class="form_instructions col">
                <h3>Instructions</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        A Vehicle type must be chosen before the Pickup Docket can be printed
                    </li>
                    <li class="list-group-item">
                        The Pickup Docket must be printed before the Put Away Items form gets activated
                    </li>
                    <li class="list-group-item">
                        Clicking the &ldquo;Print Pickup Docket&rdquo; button will assign the selected vehicle type
                    </li>
                    <li class="list-group-item">
                        The &ldquo;Print Pickup Docket&rdquo; button gets activated once a vehicle type is chosen
                    </li>
                    <li class="list-group-item">
                        Read the number of items on each pallet from its docket/label and select the location it has been put in
                    </li>
                </ul>
            </div>
        </div>
        <div id="putaway_holder" class="my-2 p-2 border border-secondary rounded bg-light">
            <h4 class="text-center">Assign Vehicle<br>Print Pickup Docket</h3>
            <div class="row">
                <div class="offset-md-2 col-md-4 mb-3">
                    <select name="vehicle_type" class="selectpicker vehicle_type" data-pickupid='<?php echo $pickup_id;?>' data-style="btn-outline-secondary btn-sm"><option value="0">--Select Vehicle Type--</option><?php echo Utility::getVehicleTypeSelect($pickup['vehicle_type']);?></select>
                </div>
                <div class="col-md-4">
                    <a id="print_docket_<?php echo $pickup_id;?>" class="btn btn-block btn-outline-secondary print_docket" role="button" target="_blank" href="/pdf/printPickupDocket/pickup=<?php echo $pickup_id;?>/vehicle=<?php echo $pickup['vehicle_type'];?>">Print Pickup Docket</a>
                </div>
            </div>
        </div>
        <div id="putaway_holder" class="my-2 p-2 border border-secondary rounded bg-light">
            <div id="cover" class="<?php echo $cover_class;?>">
                <form id="pickup_putaways" method="post" action="/form/procPickupPutaways">
                    <h3 class="text-center">Put Away Items</h3>
                    <?php foreach($items as $i):
                        list($item_id, $item_name, $item_sku, $pallet_count) = explode("|",$i);
                        $pc = 1;
                        while($pc <= $pallet_count):?>
                            <div class="border-bottom border-secondary border-bottom-dashed pt-2">
                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        Pallet <?php echo $pc;?> of <?php echo $item_name." (".$item_sku.")";?>
                                    </div>
                                    <div class="col-sm-2 mb-3">
                                        <input name="items[][<?php echo $item_id;?>]['qty']" class="form-control required number" placeholder="qty">
                                    </div>
                                    <div class="col-sm-3 mb-3">
                                        <select name="items[][<?php echo $item_id;?>]['location_id']" class="form-control selectpicker" data-live-search="true" data-style="btn-outline-secondary" required><option value="0">Select Location</option><?php echo $this->controller->location->getSelectEmptyLocations();?></select>
                                    </div>
                                </div>
                            </div>
                        <?php ++$pc; endwhile;?>
                    <?php endforeach;?>
                    <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
                    <input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id;?>" />
                    <input type="hidden" name="pickup_id" id="pickup_id" value="<?php echo $pickup_id;?>" />
                    <div class="form-group row">
                        <div class="offset-sm-6 col-sm-4 pt-2">
                            <button type="submit" class="btn btn-sm btn-outline-secondary">Put Items Away</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>