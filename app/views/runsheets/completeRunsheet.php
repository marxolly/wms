<?php

?>
<div id="page-wrapper">
    <div id="page_container" class="container-xl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <?php if($runsheet_id == 0):?>
            <?php include(Config::get('VIEWS_PATH')."layout/page-includes/no_runsheet_id.php");?>
        <?php elseif($driver_id == 0):?>
            <?php include(Config::get('VIEWS_PATH')."layout/page-includes/no_driver_id.php");?>
        <?php elseif(empty($tasks)):?>
            <?php include(Config::get('VIEWS_PATH')."layout/page-includes/no_tasks_found.php");?>
        <?php else:?>
            <?php
            //$driver_id = (empty(Form::value('driver_id')))? $runsheet['driver_id'] : Form::value('driver_id');
            //$units = (empty(Form::value('units')))? ($runsheet['units'] > 0)?$runsheet['units']: "" : Form::value('units');
            //echo "<p>Form Values For 381: ".getFormValue()."</p>";
            echo "<pre>",print_r($tasks),"</pre>";//die();
            ?>
            <div class="row">

            </div>
        <?php endif;?>
    </div>
</div>