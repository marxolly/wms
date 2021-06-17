<?php

?>
<div id="page-wrapper">
    <div id="page_container" class="container-xl">
        <input type="hidden" id="client_id" value="<?php echo $client_id;?>">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <div class="row">
            <div class="col">
                <h4 class="text-center">Colour Selection Preview</h4>
            </div>
        </div>
        <div id="style_preview">
            <p class="text-center"><img class='loading' src='/images/preloader.gif' alt='loading...' /><br />Generating Preview...</p>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php if(isset($_SESSION['feedback'])) :?>
                   <div class='feedbackbox'><?php echo Session::getAndDestroy('feedback');?></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div id="styling_instructions" class="col m-2 p-3 border-rounded">
                <p>Choose a colour by clicking on the coloured square and selecting the required colour</p>
                <p>RGB colour codes will be converted to HEX codes</p>
                <p>Click the "Default" checkbox to keep the predesignated FSG colours</p>
                <p>Invalid code entries will revert to standard Greys</p>
            </div>
        </div>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <?php echo Form::displayError('general');?>
        <form id="adjust-style-colours" action="/form/procAdjustColours" method="post">
            <div class="p-3 m-2 border rounded row">
                <div class="col-md-3" style="margin: auto 1px">
                    <h4>Card Border Colour</h4>
                </div>
                <div class="col-md-3">
                    <label class="col-form-label">Colour</label>
                    <div class="colour-picker input-group mb-3">
                        <input type="text" class="form-control required" name="card_border_colour" id="card_border_colour" data-defaultvalue="<?php echo STYLE_DEFAULTS['card_border_colour'];?>" value="<?php echo $styles['card_border_colour'];?>" >
                        <div class="input-group-append">
                            <span class="input-group-text colorpicker-input-addon"><i></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <label class="col-form-label" for="default_0">Use Default</label>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input defaultbox" data-section="card_border_colour" id="default_0" name="default_0" />
                        <label class="custom-control-label" for="default_0"></label>
                    </div>
                </div>
                <div class="col-md-2 text-right">
                    <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
                    <input type="hidden" name="line_id" value="<?php  if(isset($styles['id'])) echo $styles['id']; else echo "0";?>" />
                    <input type="hidden" name="line" value="<?php echo $styles['card_border_colour'];?>" />
                    <p><button data-section="card_border_colour" class="btn btn-sm btn-outline-fsg preview">Preview Changes</button></p>
                    <p class="mb-0"><button type="submit" class="btn btn-sm btn-outline-fsg">Save Changes</button></p>
                </div>
            </div>
            <div class="p-3 m-2 border rounded row">
                <div class="col-md-3" style="margin: auto 1px">
                    <h4>Card Header Background</h4>
                </div>
                <div class="col-md-3">
                    <label class="col-form-label">Colour</label>
                    <div class="colour-picker input-group mb-3">
                        <input type="text" class="form-control required" name="card_header_background" id="card_header_background" data-defaultvalue="<?php echo STYLE_DEFAULTS['card_header_background'];?>" value="<?php echo $styles['card_header_background'];?>" >
                        <div class="input-group-append">
                            <span class="input-group-text colorpicker-input-addon"><i></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <label class="col-form-label" for="default_0">Use Default</label>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input defaultbox" data-section="card_header_background" id="default_1" name="default_1" />
                        <label class="custom-control-label" for="default_1"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
                <input type="hidden" name="line_id" value="<?php  if(isset($styles['id'])) echo $styles['id']; else echo "0";?>" />
                <div class="col-md-2 offset-md-6">
                    <button id="preview_changes" class="btn btn-sm btn-outline-fsg">Preview Changes</button>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-sm btn-outline-fsg">Save Changes</button>
                </div>
            </div>
        </form>






        <?php echo "<pre>",print_r($styles),"</pre>";?>

    </div>
</div>