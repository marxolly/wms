<input type="hidden" id="admin_from_value" value="<?php echo strtotime('last friday', strtotime('-3 months'));?>" />
<input type="hidden" id="admin_to_value" value="<?php echo strtotime('last friday', strtotime('tomorrow'));?>" />
<div class="card-columns homepagecolumns">
    <div class="card ordersholdercard">
        <div class="card-header homepagecolumn text-center">
            <h2><i class="fal fa-shopping-cart"></i> Orders</h2>
        </div>
        <div class="card-body">
            <?php if(count($orders)):?>
                <div class="card-deck homepagedeck">
                    <?php foreach($orders as $o):
                        $logo_path = DOC_ROOT.'/images/client_logos/tn_'.$o['logo'];
                        $s = ($o['order_count'] > 1)? "s" : ""; ?>
                        <div class="card homepagecard">
                            <div class="card-header d-flex align-items-center">
                                <div class="row">
                                    <?php if(file_exists($logo_path)):?>
                                        <div class="col-5 d-sm-none d-md-block col-md-5">
                                            <img src="/images/client_logos/tn_<?php echo $o['logo'];?>" alt="client logo" class="img-thumbnail" />
                                        </div>
                                        <div class="col-7 col-sm-12 col-md-7">
                                    <?php else:?>
                                        <div class="col">
                                    <?php endif;?>
                                        <h5 class="d-none d-md-block"><?php echo $o['client_name'];?></h5>
                                        <h4 class="d-md-none"><?php echo $o['client_name'];?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                            	<i class="fal fa-shopping-cart fa-2x" style="vertical-align:middle;"></i>&nbsp;<span style="font-size:larger"><?php echo $o['order_count'];?> New Order<?php echo $s;?></span>
                            </div>
                            <div class="card-footer text-center">
                                <a class="btn btn-outline-order" href="/orders/view-orders/client=<?php echo $o['client_id'];?>">Manage Orders</a>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            <?php else:?>
                <div class="errorbox">
                    <h2><i class="fas fa-exclamation-triangle"></i> No Orders Listed</h2>
                    <p>There are no unfulfilled orders listed in the system</p>
                </div>
            <?php endif;?>
        </div>
    </div>
    <div class="card deliveriesholdercard">
        <div class="card-header homepagecolumn text-center">
            <h2><i class="fad fa-shipping-fast"></i> Deliveries</h2>
        </div>
        <div class="card-body">
            <?php if(count($deliveries)):?>
                <div class="card-deck homepagedeck">
                    <?php foreach($deliveries as $d):
                        $logo_path = DOC_ROOT.'/images/client_logos/tn_'.$d['logo'];
                        $s = ($d['delivery_count'] > 1)? "Deliveries" : "Delivery"; ?>
                        <div class="card homepagecard">
                            <div class="card-header d-flex align-items-center">
                                <div class="row">
                                    <?php if(file_exists($logo_path)):?>
                                        <div class="col-5 d-sm-none d-md-block col-md-5">
                                            <img src="/images/client_logos/tn_<?php echo $d['logo'];?>" alt="client logo" class="img-thumbnail" />
                                        </div>
                                        <div class="col-7 col-sm-12 col-md-7">
                                    <?php else:?>
                                        <div class="col">
                                    <?php endif;?>
                                       <h5 class="d-none d-md-block"><?php echo $d['client_name'];?></h5>
                                       <h4 class="d-md-none"><?php echo $d['client_name'];?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                            	<i class="fad fa-shipping-fast fa-2x" style="vertical-align: middle;"></i>&nbsp;<span style="font-size:larger"><?php echo $d['delivery_count'];?> New <?php echo $s;?></span>
                            </div>
                            <div class="card-footer text-center">
                                <a class="btn btn-outline-delivery" href="/deliveries/manage-deliveries/client=<?php echo $d['client_id'];?>">Manage Deliveries</a>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            <?php else:?>
                <div class="errorbox">
                    <h2><i class="fas fa-exclamation-triangle"></i> No Deliveries Listed</h2>
                    <p>There are no open deliveries listed in the system</p>
                </div>
            <?php endif;?>
        </div>
    </div>
    <div class="card pickupsholdercard">
        <div class="card-header homepagecolumn text-center">
            <h2><i class="fad fa-shipping-fast fa-flip-horizontal"></i> Pickups</h2>
        </div>
        <div class="card-body">
            <?php if(count($pickups)):?>
                <div class="card-deck homepagedeck">
                    <?php foreach($pickups as $p):
                        $logo_path = DOC_ROOT.'/images/client_logos/tn_'.$p['logo'];
                        $s = ($p['pickup_count'] > 1)? "s" : "";  ?>
                        <div class="card homepagecard">
                            <div class="card-header d-flex align-items-center">
                                <div class="row">
                                    <?php if(file_exists($logo_path)):?>
                                        <div class="col-5 d-sm-none d-md-block col-md-5">
                                            <img src="/images/client_logos/tn_<?php echo $p['logo'];?>" alt="client logo" class="img-thumbnail" />
                                        </div>
                                        <div class="col-7 col-sm-12 col-md-7">
                                    <?php else:?>
                                        <div class="col">
                                    <?php endif;?>
                                        <h5 class="d-none d-md-block"><?php echo $p['client_name'];?></h5>
                                        <h4 class="d-md-none"><?php echo $p['client_name'];?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                            	<i class="fad fa-shipping-fast fa-2x fa-flip-horizontal" style="vertical-align: middle;"></i>&nbsp;<span style="font-size:larger"><?php echo $p['pickup_count'];?> New Pickup<?php echo $s;?></span>
                            </div>
                            <div class="card-footer text-center">
                                <a class="btn btn-outline-pickup" href="/deliveries/manage-pickups/client=<?php echo $p['client_id'];?>">Manage Pickups</a>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            <?php else:?>
                <div class="errorbox">
                    <h2><i class="fas fa-exclamation-triangle"></i> No Pickups Listed</h2>
                    <p>There are no open pickups listed in the system</p>
                </div>
            <?php endif;?>
        </div>
    </div>
    <div class="card backordersholdercard">
        <div class="card-header homepagecolumn text-center">
            <h2><span class="fa-layers fa-fw"><i class="fal fa-exchange" data-fa-transform="shrink-4 up-1 left-8"></i><i class="fal fa-truck"></i></span> Backorders</h2>
        </div>
        <div class="card-body">
            <?php if(count($backorders)):?>
                <div class="card-deck homepagedeck">
                    <?php foreach($backorders as $bo):
                        $logo_path = DOC_ROOT.'/images/client_logos/tn_'.$bo['logo'];
                        $s = ($bo['order_count'] > 1)? "s" : "";  ?>
                        <div class="card homepagecard">
                            <div class="card-header d-flex align-items-center">
                                <div class="row">
                                    <?php if(file_exists($logo_path)):?>
                                        <div class="col-5 d-sm-none d-md-block col-md-5">
                                            <img src="/images/client_logos/tn_<?php echo $bo['logo'];?>" alt="client logo" class="img-thumbnail" />
                                        </div>
                                        <div class="col-7 col-sm-12 col-md-7">
                                    <?php else:?>
                                        <div class="col">
                                    <?php endif;?>
                                        <h5 class="d-none d-md-block"><?php echo $bo['client_name'];?></h5>
                                        <h4 class="d-md-none"><?php echo $bo['client_name'];?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                            	<span class="fa-2x"><span class="fa-layers fa-fw"><i class="fal fa-exchange" data-fa-transform="shrink-4 up-1 left-8"></i><i class="fal fa-truck"></i></span></span>&nbsp;<span style="font-size:larger"><?php echo $bo['order_count'];?> Backorder<?php echo $s;?></span>
                            </div>
                            <div class="card-footer text-center">
                                <a class="btn btn-outline-backorder" href="/orders/view-backorders/client=<?php echo $bo['client_id'];?>">Manage Backorders</a>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            <?php else:?>
                <div class="errorbox">
                    <h2><i class="fas fa-exclamation-triangle"></i> No Backorders Listed</h2>
                    <p>There are no backorders listed in the system</p>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>
<div class="col-md-12 text-center">
    <h2>Recent Client Activity</h2>
</div>
<div id="order_activity_chart"></div>
<div class="col-md-12 text-right">
    <button class="btn btn-sm btn-outline-fsg" style="display:none" id="chart_button_1"></button>
</div>