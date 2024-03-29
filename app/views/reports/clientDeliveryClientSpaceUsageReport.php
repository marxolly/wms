<?php
//echo "<p>THE_DATE: ".date("Y-m-d H:i:s", $date)."</p>";
//echo "<p>TIMESTAMP: ".$date."</p>";
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id;?>" />
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/between_dates.php");?>
        <?php //echo "<pre>",print_r($bays),"</pre>"; die();?>
        <?php if(count($bays)):?>
            <div id="waiting" class="row">
                <div class="col-lg-12 text-center">
                    <h2>Drawing Table..</h2>
                    <p>May take a few moments</p>
                    <img class='loading' src='/images/preloader.gif' alt='loading...' />
                </div>
            </div>
            <div class="row" id="table_holder" style="display:none">
                <div class="col-lg-12">
                    <table id="delivery_client_space_usage_table" class="table-striped table-hover" style="width:99%">
                        <thead>
                            <tr>
                                <th data-priority="1">Bay Name</th>
                                <th data-priority="2">Date Added</th>
                                <th data-priority="2">Date Removed</th>
                                <th>Item</th>
                                <th>Size</th>
                                <th data-priority="1">Days Held Between<br><?php echo date("d/m/Y", $from);?> and <?php echo date("d/m/Y", $to);?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($bays as $b):
                                $date_removed = ($b['date_removed'] > 0)? date("d/m/Y", $b['date_removed']): "";?>
                                <tr id="row_<?php echo $b['client_bay_id'];?>">
                                    <td><?php echo$b['location'];?></td>
                                    <td><?php echo date("d/m/Y", $b['date_added']);?></td>
                                    <td><?php if($b['date_removed'] > 0) echo $date_removed;?></td>
                                    <td><?php echo $b['item_name'];?></td>
                                    <td><?php echo ucwords($b['size']);?></td>
                                    <td class="number"><?php echo $b['days_held'];?></td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else:?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="errorbox">
                        <h2>No Space Usage Found</h2>
                        <p>There are no spaces listed as being used between<br><?php echo date("d/m/Y", $from);?> and <?php echo date("d/m/Y", $to);?></p>
                        <p>If you believe this is an error, please let us know</p>
                        <p>Alternatively, use the date selectors above to change the date range</p>
                    </div>
                </div>
            </div>
        <?php endif;?>
    </div>
</div>