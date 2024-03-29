<?php
$suburb = Form::value('suburb');
$state = Form::value('state');
$postcode = Form::value('postcode');
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <div id="feedback_holder" style="display:none;"></div>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <?php echo Form::displayError('general');?>
        <form id="get_quotes" method="post" action="/form/procGetQuotes">
            <div class="col-12 mb-2">
                <p class="inst">Weights are for individual boxes, not a total</p>
            </div>
            <div class="form-group row">
                <label class="col-md-2"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Suburb/Town</label>
                <div class="col-md-4">
                    <input type="text" class="form-control required" name="suburb" id="suburb" value="<?php echo $suburb;?>" />
                    <?php echo Form::displayError('suburb');?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> State</label>
                <div class="col-md-4">
                    <select id="state" name="state" class="form-control selectpicker" data-style="btn-outline-secondary" required><option value="0">--Select One--</option><?php echo Utility::getStateSelect($state);?></select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Postcode</label>
                <div class="col-md-4">
                    <input type="text" class="form-control required" name="postcode" id="postcode" value="<?php echo $postcode;?>" />
                </div>
            </div>
            <div class="p-3 pb-0 mb-2 rounded-top mid-grey">
                <div class="row mb-0">
                    <div class="col-md-4">
                        <h4>Packages</h4>
                    </div>
                    <div class="col-md-4">
                        <a class="add-package" style="cursor:pointer" title="Add Another Package"><h4><i class="fad fa-plus-square text-success"></i> Add another</a></h4>
                    </div>
                    <div class="col-md-4">
                        <a id="remove-all-packages" style="cursor:pointer" title="Leave Only One"><h4><i class="fad fa-times-square text-danger"></i> Leave only one</a></h4>
                    </div>
                </div>
                <div id="packages_holder">
                    <?php include(Config::get('VIEWS_PATH')."layout/page-includes/add_quote_package.php");?>
                </div>
            </div>
            <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
            <div class="form-group row">
                <div class="col-md-4 offset-md-6">
                    <button type="submit" class="btn btn-outline-secondary">Get Prices</button>
                </div>
            </div>
        </form>
    </div>
</div>