<?php

?>
<div id="page-wrapper">
    <div id="page_container" class="container-xl">
        <input type="hidden" id="client_id" value="<?php echo $client_id;?>">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <div class="row">
            <div class="col">
                <h4 class="text-center">Current Colour Selection</h4>
            </div>
        </div>
        <div id="style_preview">
            <p class="text-center"><img class='loading' src='/images/preloader.gif' alt='loading...' /><br />Generating Preview...</p>
        </div>
        <form class="adjust-style-colours mb-3 p-3 border rounded" action="/form/procAdjustColours" method="post">
            <div class="form-group row">
                <div class="col-md-2" style="margin: auto">
                    <h4>Card Border Colour</h4>
                </div>
                <div class="col-md-3">
                    <label class="col-form-label">Colour</label>
                    <div class="colour-picker input-group">
                        <input type="text" class="form-control" name="card_border_colour" id="card_border_colour" value="<?php echo $styles['card_border_colour'];?>" >
                        <div class="input-group-append">
                            <span class="input-group-text colorpicker-input-addon"><i></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 text-right">
                    <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
                    <input type="hidden" name="line_id" value="<?php  if(isset($styles['id'])) echo $styles['id']; else echo "0";?>" />
                    <input type="hidden" name="line" value="<?php echo $styles['card_border_colour'];?>" />
                    <p><button id="preview" class="btn btn-sm btn-outline-fsg">Preview Changes</button></p>
                    <p><button type="submit" class="btn btn-sm btn-outline-fsg">Save Changes</button></p>
                </div>
            </div>
        </form>





        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <?php echo Form::displayError('general');?>
        <?php echo "<pre>",print_r($styles),"</pre>";?>
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