<?php

?>
<input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id;?>" />
<div id="page-wrapper">
    <div id="page_container" class="container-xl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <div class="row">
            <div class="col text-center">
                <span class="inst">These are deliveries yet to be completed.<br>Complete deliveries can be found in the "Reports" section</span>
            </div>
        </div>
    </div>
</div>