<?php

?>
<div id="page-wrapper">
    <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
    <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
    <div class="row">
        <form id="bulk-order-csv-upload" method="post" action="/form/procBulkOrderAdd" enctype="multipart/form-data">
            <div class="form-group row">
                <label class="col-md-3 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Client</label>
                <div class="col-md-4">
                    <select id="client_id" name="client_id" class="form-control selectpicker"><option value="0">--Select One--</option><?php echo $this->controller->client->getSelectClients(Form::value('client_id'));?></select>
                    <?php echo Form::displayError('client_id');?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> CSV File</label>
                <div class="col-md-4">
                    <input type="file" name="csv_file" id="csv_file" class="required" />
                    <?php echo Form::displayError('csv_file');?>
                </div>
            </div>
            <div class="form-group row">
                <div class="form-check">
                    <label class="form-check-label col-md-3" for="header_row">My CSV has a header row</label>
                    <div class="col-md-4 checkbox checkbox-default">
                        <input class="form-check-input styled" type="checkbox" id="header_row" name="header_row" checked="checked" />
                        <label for="header_row"></label>
                    </div>
                </div>
            </div>
            <input type="hidden" name="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
            <div class="form-group row">
                <label class="col-md-3 col-form-label">&nbsp;</label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Upload It</button>
                </div>
            </div>
        </form>
    </div>
</div>