<?php

?>
<div id="page-wrapper">
    <div id="page_container" class="container-xl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <?php if($error):?>
            <?php if($error == "no_po_id"):
                include(Config::get('VIEWS_PATH')."layout/page-includes/no_po_id.php");
            elseif($error == "no_po"):
                include(Config::get('VIEWS_PATH')."layout/page-includes/no_po_found.php");
            endif;?>
        <?php else:?>
            <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
            <?php echo "<pre>FORM VALUES",print_r(Form::$values),"</pre>"; ?>
            <?php echo "<pre>PO VALUE",print_r($po_info),"</pre>"; ?> 
        <?php endif;?>
    </div>
</div>