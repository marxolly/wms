<?php
//echo "dl_details<pre>",print_r($dl_details),"</pre>";
//echo "sender_details<pre>",print_r($sender_details),"</pre>";

$address_string = $dl_details['ship_to'];
if(!empty($dl_details['attention'])) $address_string .= "<br>".$dl_details['attention'];
$address_string .= "<br>".$dl_details['address'];
if(!empty($dl_details['address2'])) $address_string .= "<br>".$dl_details['address2'];
$address_string .= "<br>".$dl_details['suburb']." ".$dl_details['state']." ".$dl_details['postcode'];
$bc = (!empty($dl_details['box_count']))? $dl_details['box_count'] : 1;
$pc = (!empty($dl_details['pallet_count']))? $dl_details['pallet_count'] : 0;
$box_label = "Box";
if(isset($dl_details['order_number']))
{
    $bc = (!empty($dl_details['box_count']))? $dl_details['box_count'] : 0;
    $pc = (!empty($dl_details['pallet_count']))? $dl_details['pallet_count'] : 0;
    $box_label = "Box/Pallet";
}
$bc += $pc;
$job_number = "";
$job_number_label = "Job Number:";
$po_string = "";
if($sender_details['send_job_no'] != 1)
{
    $job_number = $dl_details['po_number'];
    $job_number_label = "Order Number:";
}
elseif(isset($dl_details['order_number']))
{
    $job_number = $dl_details['order_number'];
    $job_number_label = "WMS Order Number:";
}
elseif(!empty($dl_details['po_number']))
{
    $po_string = "
            <tr>
                <td class='w50'>&nbsp;</td>
                <td class='spacer'>&nbsp;</td>
                <td class='po_number'>PO: {$dl_details['po_number']}</td>
            </tr>
    ";
}
$lb = 0;
if(!empty($dl_details['per_box']))
{
    $lb = $dl_details['quantity'] - ( ($bc - 1) * $dl_details['per_box'] );
}
$tb = 1;
?>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<body>
    <?php while ($tb <= $bc):?>
    <div class="dl_body">
        <?php if($sender_details['send_job_no'] != 1):?>
            <table class="cprc">
                <tr>
                    <td class="cp_po_number"><?php echo $dl_details['po_number'];?></td>
                </tr>
                <tr>
                    <td class="cp_title"><?php echo $dl_details['job_title'];?></td>
                </tr>
                <tr>
                    <td class="cp_qib">Qty in box: <?php if($tb < $bc) echo $dl_details['per_box']; else echo $lb;?></td>
                </tr>
            </table>
            <table class="cprc_bc">
                <tr>
                    <td>Box <?php echo $tb;?> of <?php echo $bc;?></td>
                </tr>
            </table>
        <?php else:?>
            <table class="address_details">
                <tr>
                    <td><strong>T0:</strong></td>
                    <td class="spacer">&nbsp;</td>
                    <td><?php echo $address_string;?></td>
                </tr>
            </table>
            <table class="label_details">
                <tr>
                    <td class="w50">Reference:</td>
                    <td class="spacer">&nbsp;</td>
                    <td><?php echo $dl_details['job_title'];?></td>
                </tr>
                <tr>
                    <td class="w50"><?php echo $job_number_label;?></td>
                    <td class="spacer">&nbsp;</td>
                    <td><?php echo $job_number;?></td>
                </tr>
                <?php echo $po_string;?>
                <tr>
                    <td class="w50"></td>
                    <td class="spacer">&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <table class="box_details">
                <tr>
                    <td class="right-align"><?php echo $box_label;?> <strong><?php echo $tb;?></strong> of <strong><?php echo $bc;?></strong></td>
                    <?php if(!empty($dl_details['per_box'])):?>
                        <td class="right-align">( <strong><?php if($tb < $bc) echo $dl_details['per_box']; else echo $lb;?></strong> items in box )</td>
                    <?php endif;?>
                </tr>

            </table>
        <?php endif;?>
    </div>
    <?php if($tb < $bc):?>
        <pagebreak />
    <?php endif; ++$tb;
    endwhile;?>
</body