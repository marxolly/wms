                <div class="row">
                    <div class="col">
                        <h2>Details For Order Number: <?php echo $order['order_number'];?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                        <div class="card border-secondary h-100 order-card">
                            <div class="card-header bg-secondary text-white">
                                Delivery Details
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <label class="col-5">Client Order Number</label>
                                    <div class="col-7"><?php echo $order['client_order_id'];?></div>
                                </div>
                                <div class="row">
                                    <label class="col-5">Deliver To</label>
                                    <div class="col-7"><?php echo $order['ship_to'];?></div>
                                </div>
                                <div class="row">
                                    <label class="col-5">Company</label>
                                    <div class="col-7"><?php echo $order['company_name'];?></div>
                                </div>
                                <div class="row">
                                    <label class="col-5">Address</label>
                                    <div class="col-7"><?php echo $order['address'];?></div>
                                </div>
                                <?php if(!empty($order['address_2'])):?>
                                    <div class="row">
                                        <label class="col-5">&nbsp;</label>
                                        <div class="col-7"><?php echo $order['address_2'];?></div>
                                    </div>
                                <?php endif;?>
                                <div class="row">
                                    <label class="col-5">&nbsp;</label>
                                    <div class="col-7"><?php echo $order['suburb'];?></div>
                                </div>
                                <div class="row">
                                    <label class="col-5">&nbsp;</label>
                                    <div class="col-7"><?php echo $order['state'];?></div>
                                </div>
                                <div class="row">
                                    <label class="col-5">&nbsp;</label>
                                    <div class="col-7"><?php echo $order['postcode'];?></div>
                                </div>
                                <div class="row">
                                    <label class="col-5">&nbsp;</label>
                                    <div class="col-7"><?php echo $order['country'];?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                        <div class="card border-secondary h-100 order-card">
                            <div class="card-header bg-secondary text-white">
                                Order Status
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <label class="col-5">Order Status</label>
                                    <div class="col-7"><?php echo $order_status;?></div>
                                </div>
                                <div class="row">
                                    <label class="col-5">Date Ordered</label>
                                    <div class="col-7"><?php echo date('d-m-Y', $order['date_ordered']);?></div>
                                </div>
                                <div class="row">
                                    <label class="col-5">Date Fulfilled</label>
                                    <div class="col-7"><?php if($order['date_fulfilled'] > 0)echo date('d-m-Y', $order['date_fulfilled']);?></div>
                                </div>
                                <div class="row">
                                    <label class="col-5">Courier Service</label>
                                    <div class="col-7"><?php echo $courier;?></div>
                                </div>
                                <div class="row">
                                    <label class="col-5">Use Express</label>
                                    <div class="col-7"><?php if($order['eparcel_express'] > 0) echo "Yes"; else echo "No";?></div>
                                </div>
                                <div class="row">
                                    <label class="col-5">Signature Required</label>
                                    <div class="col-7"><?php if($order['signature_req'] > 0) echo "Yes"; else echo "No";?></div>
                                </div>
                                <div class="row">
                                    <label class="col-5">Consignment ID</label>
                                    <div class="col-7"><?php if($order['date_fulfilled'] > 0)echo $order['consignment_id'];?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                        <div class="card border-secondary h-100 order-card">
                            <div class="card-header bg-secondary text-white">
                                Order Items
                            </div>
                            <div class="card-body order-items">
                                <?php foreach($products as $p):?>
                                    <div class="border-bottom border-secondary border-bottom-dashed mb-3">
                                        <div class="row">
                                            <label class="col-5">Name</label>
                                            <div class="col-7"><?php echo $p['name'];?></div>
                                        </div>
                                        <div class="row">
                                            <label class="col-5">SKU</label>
                                            <div class="col-7"><?php echo $p['sku'];?></div>
                                        </div>
                                        <div class="row">
                                            <label class="col-5">QTY</label>
                                            <div class="col-7"><?php echo $p['qty'];?></div>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>