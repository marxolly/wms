<table id="view_pickups_table" class="table-striped table-hover" style="width:90%">
    <thead>
        <tr>
            <th data-priority="10001">Pickup Number</th>
            <th>Pickup Address</th>
            <th data-priority="3">Pickup Reference</th>
            <th>Requested Date/Time<br>Urgency</th>
            <th>Items</th>
            <th data-priority="1">Progress</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pickups as $d):
            $address_string = "";
            if(!empty($d['address'])) $address_string .= $d['address'];
            if(!empty($d['address_2'])) $address_string .= "<br/>".$d['address_2'];
            if(!empty($d['suburb'])) $address_string .= "<br/>".$d['suburb'];
            if(!empty($d['state'])) $address_string .= "<br/>".$d['state'];
            if(!empty($d['country'])) $address_string .= "<br/>".$d['country'];
            if(!empty($d['postcode'])) $address_string .= "<br/>".$d['postcode'];
            $pc = ceil($d['stage']/$d['total_stages']*100);
            $items = explode("~",$d['items']);
            ?>
            <tr>
                <td><?php echo $d['pickup_number'];?></td>
                <td>
                    <p><?php echo $address_string;?></p>
                </td>
                <td>
                    <p>Booked By: <span class='font-weight-bold'><?php echo $d['requested_by_name'];?></span></p>
                    <?php if(!empty($d['client_reference'])) echo "<p>Reference: <span class='font-weight-bold'>".$d['client_reference']."</span></p>";?>
                </td>
                <td class="bg-<?php echo $d['pickup_window_class'];?> delivery-window">
                    <?php echo date('D d/m/Y - g:i A', $d['date_entered']);?><br>
                    <?php echo ucwords($d['pickup_window']);?>
                </td>
                <td>
                    <div class="item_list border-bottom border-secondary border-bottom-dashed mb-3 ">
                        <?php foreach($items as $i):
                            list($item_id, $item_name, $item_sku, $pallet_count) = explode("|",$i);?>
                            <p><span class="iname"><?php echo $item_name."(".$item_sku.")";?>:</span> <span class="font-weight-bold"><?php echo $pallet_count;?> Pallet(s)</span></p>
                        <?php endforeach;?>
                    </div>
                </td>
                <td>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-<?php echo $d['status_class'];?>" role="progressbar" aria-valuenow="<?php echo $pc;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $pc;?>%"></div>
                    </div>
                    <div class="text-center mt-0"><?php echo strtoupper($d['status']);?></div>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>