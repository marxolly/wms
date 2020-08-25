<?php

?>
<div id="page-wrapper">
    <div id="page_container" class="container-xl">
        <?php include(Config::get('VIEWS_PATH')."layout/page-includes/page_top.php");?>
        <div class="row">
            <div class="col-lg-3 col-md-6"><p><a href="/user/add-user" class="btn btn-outline-fsg">Add New User</a></p></div>
            <div class="col-lg-3 col-md-6"><p><a href="/site-settings/manage-users/" class="btn btn-outline-success">View Only Active Users</a></p></div>
            <div class="col-lg-3 col-md-6"><p><a href="/site-settings/manage-users/active=0" class="btn btn-outline-danger">View Only Inactive Users</a></p></div>
            <div class="col-lg-3 col-md-6"><p><a href="/site-settings/manage-users/active=-1" class="btn btn-outline-warning">View All Users</a></p></div>
        </div>
        <div class="row">
            <?php foreach($user_roles as $ur):
                if(!$this->controller->user->canManageRole($ur['id']))
                    continue;
                $name = ucwords($ur['name']);?>
                <div class="col-md-12 col-lg-6 mb-3">
                    <div class="card h-100 border-secondary order-card">
                        <div class="card-header bg-secondary text-white">
                            <?php echo $name;?> Users
                        </div>
                        <div class="card-body">
                            <?php $i = 1;
                            foreach($this->controller->user->getAllUsersByRoleID($ur['id'], $active) as $user):?>
                                <div class="container-fluid">
                                    <div class="row border-bottom-dashed mb-3">
                                        <div class="col-10">

                                        </div>
                                        <div class="col-2">
                                            <?php if($user['active'] > 0):?>
                                                <a class="btn btn-outline-danger deactivate" data-userid="<?php echo $user['id'];?>">Deactivate User</a>
                                            <?php else:?>
                                                <a class="btn btn-outlinesuccess reactivate" data-userid="<?php echo $user['id'];?>">Reactivate User</a>
                                            <?php endif;?>
                                            <a class="btn btn-outline-secondary" href="/user/edit-user-profile/user=<?php echo $user['id'];?>">Edit Profile</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>