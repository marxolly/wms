<?php

?>
<div id="page-wrapper">
    <div id="page_container" class="container-xl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <?php echo Form::displayError('general');?>
        <form id="adjust_colours"  method="post" enctype="multipart/form-data" action="/form/procAdjustColours">
            <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
            <div class="form-group row">
                <div class="col-md-4 offset-col-md3">
                    <button type="submit" class="btn btn-outline-fsg">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>