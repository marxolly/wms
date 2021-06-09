<?php
$name = (empty(Form::value('name')))? $info['name'] : Form::value('name');
$email = (empty(Form::value('email')))? $info['email'] : Form::value('email');
$role_id = (empty(Form::value('role_id')))? $info['role_id'] : Form::value('role_id');
$client_id = (empty(Form::value('client_id')))? $info['client_id'] : Form::value('client_id');

$display = (  ( $role_id == $client_role_id || $role_id == $client_admin_role_id )  )? "block" : "none";
?>
<div id="page-wrapper">
    <div id="page_container" class="container-xl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <div class="row">
            <div class="col-lg-12">
                <h2>Update A User profile</h2>
            </div>
        </div>
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/form-top.php");?>
        <?php echo Form::displayError('general');?>
        <form id="profile_update" method="post" enctype="multipart/form-data" action="/form/procAdminProfileUpdate">
            <div class="form-group row">
                <label class="col-md-3 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Name</label>
                <div class="col-md-4">
                    <input type="text" class="form-control required" name="name" id="name" value="<?php echo $name;?>" />
                    <?php echo Form::displayError('name');?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Email</label>
                <div class="col-md-4">
                    <input type="text" class="form-control required email" name="email" id="email" value="<?php echo $email;?>" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Role</label>
                <div class="col-md-4">
                    <select id="role_id" name="role_id" class="form-control selectpicker" data-style="btn-outline-secondary"><option value="0">--Select One--</option><?php echo $this->controller->user->getSelectUserRoles($role_id);?></select>
                    <?php echo Form::displayError('role_id');?>
                </div>
            </div>
            <div id="client_holder" style="display: <?php echo $display;?>">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label"><sup><small><i class="fas fa-asterisk text-danger"></i></small></sup> Client</label>
                    <div class="col-md-4">
                        <select id="client_id" name="client_id" class="form-control selectpicker" data-style="btn-outline-secondary"><option value="0">--Select One--</option><?php echo $this->controller->client->getSelectClients($client_id);?></select>
                        <?php echo Form::displayError('client_id');?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Profile Image</label>
                <div class="col-md-4">
                    <input type="file" name="image" id="image" />
                    <?php echo Form::displayError('image');?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Current Image</label>
                <div class="col-md-4">
                    <div class="col-md-4">
                        <img src="<?php echo $info['image'];?>" class="thumbnail profile-thumb" />
                    </div>
                    <div class="col-md-6 checkbox checkbox-default">
                        <input class="form-check-input styled" type="checkbox" id="delete_image" name="delete_image" />
                        <label for="delete_image"><small><em>Revert to default</em></small></label>
                    </div>
                </div>
            </div>
            <!-- Hidden Inputs -->
            <input type="hidden" name="csrf_token" id="csrf_token" value="<?php echo Session::generateCsrfToken(); ?>" />
            <input type="hidden" name="client_id" value="<?php echo $info['client_id'];?>" />
            <input type="hidden" name="role_id" value="<?php echo $info['role_id'];?>" />
            <input type="hidden" name="user_id" value="<?php echo $info['id'];?>" />
            <!-- Hidden Inputs -->
            <div class="form-group row">
                <label class="col-md-3 col-form-label">&nbsp;</label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-outline-fsg">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
