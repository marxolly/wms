<?php

?>
<div id="page-wrapper">
    <div id="page_container" class="container-xxl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php"); ?>
        <div class="row">
            <div class="col-md-12">
                <h2>Import Currently Stored Reece Departments</h2>
            </div>
        </div>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <form id="reece-department-upload" method="post" action="/form/procReeceDepartmentUpload" enctype="multipart/form-data">
            <div class="form-group row">
                <label class="col-md-3 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Current Data Spreadsheet</label>
                <div class="col-md-4">
                    <input type="file" name="csv_file" id="csv_file" />
                    <?php echo Form::displayError('csv_file');?>
                </div>
            </div>
            <div class="form-group row custom-control custom-checkbox custom-control-right">
                <input class="custom-control-input" type="checkbox" id="header_row" name="header_row" checked />
                <label class="custom-control-label col-md-3" for="header_row">My CSV has a header row</label>
            </div>
            <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
            <div class="form-group row">
                <label class="col-md-3 col-form-label">&nbsp;</label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-outline-secondary">Upload It</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <hr/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Check New Reece Data For Department Changes</h2>
            </div>
        </div>
        <form id="reece-supplied-data-upload-department" method="post" action="/form/procReeceDepartmentCheck" enctype="multipart/form-data">
            <div class="form-group row">
                <label class="col-md-3 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Reece Supplied Data</label>
                <div class="col-md-4">
                    <input type="file" name="reece_csv_file" id="reece_csv_file" />
                    <?php echo Form::displayError('reece_csv_file');?>
                </div>
            </div>
            <div class="form-group row custom-control custom-checkbox custom-control-right">
                <input class="custom-control-input" type="checkbox" id="reece_header_row" name="reece_header_row" checked />
                <label class="custom-control-label col-md-3" for="reece_header_row">My CSV has a header row</label>
            </div>
            <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
            <div class="form-group row">
                <label class="col-md-3 col-form-label">&nbsp;</label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-outline-secondary">Check It</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <hr/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <hr/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Import Currently Stored Reece Users</h2>
            </div>
        </div>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <form id="reece-user-upload" method="post" action="/form/procReeceUserUpload" enctype="multipart/form-data">
            <div class="form-group row">
                <label class="col-md-3 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Current Data Spreadsheet</label>
                <div class="col-md-4">
                    <input type="file" name="csv_user_file" id="csv_user_file" />
                    <?php echo Form::displayError('csv_user_file');?>
                </div>
            </div>
            <div class="form-group row custom-control custom-checkbox custom-control-right">
                <input class="custom-control-input" type="checkbox" id="user_header_row" name="user_header_row" checked />
                <label class="custom-control-label col-md-3" for="user_header_row">My CSV has a header row</label>
            </div>
            <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
            <div class="form-group row">
                <label class="col-md-3 col-form-label">&nbsp;</label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-outline-secondary">Upload It</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <hr/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Check New Reece Data For User Changes</h2>
            </div>
        </div>
        <form id="reece-supplied-data-upload-user" method="post" action="/form/procReeceUserCheck" enctype="multipart/form-data">
            <div class="form-group row">
                <label class="col-md-3 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Reece Supplied Data</label>
                <div class="col-md-4">
                    <input type="file" name="reece_user_csv_file" id="reece_user_csv_file" />
                    <?php echo Form::displayError('reece_user_csv_file');?>
                </div>
            </div>
            <div class="form-group row custom-control custom-checkbox custom-control-right">
                <input class="custom-control-input" type="checkbox" id="reece_user_header_row" name="reece_user_header_row" checked />
                <label class="custom-control-label col-md-3" for="reece_user_header_row">My CSV has a header row</label>
            </div>
            <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
            <div class="form-group row">
                <label class="col-md-3 col-form-label">&nbsp;</label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-outline-secondary">Check It</button>
                </div>
            </div>
        </form>
    </div>
</div>
