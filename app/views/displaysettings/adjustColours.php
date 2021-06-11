<?php

?>
<div id="page-wrapper">
    <div id="page_container" class="container-xl">
        <input type="hidden" id="client_id" value="<?php echo $client_id;?>">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <div id="style_preview">
            <p class="text-center"><img class='loading' src='/images/preloader.gif' alt='loading...' /><br />Generating Preview...</p>
        </div>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <?php echo Form::displayError('general');?>
        <?php echo "<pre>",print_r($styles),"</pre>";?>;?>
        <form id="adjust_colours"  method="post" enctype="multipart/form-data" action="/form/procAdjustColours">
            <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
            <div class="form-group row">
                <div class="col-md-4 offset-md-3">
                    <button type="submit" class="btn btn-outline-fsg">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>