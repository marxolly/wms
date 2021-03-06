<?php
$encryptedData = $freedomMYOB->callTask('getMYOBOrders',array());
$invoices =  json_decode($freedomMYOB->getDecryptedData($encryptedData),true);
$encryptedFileLastModified = $freedomMYOB->callTask('getEncryptedDataLastModified',array());
?>
<div id="page-wrapper">
    <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php"); ?>
    <div class="row">
        <div class="col-lg-12">
            <h2>The Freedom MYOB API</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php echo "<pre>",print_r($invoices),"</pre>";?>
            <?php echo date("Y-m-d H:i:s", $encryptedFileLastModified);?>
        </div>
    </div>
</div>
