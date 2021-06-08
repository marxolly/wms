<?php

/**
 * User controller
 *

 * @author     Mark Solly <mark.solly@fsg.com.au>
 */

class UserController extends Controller{

    public function beforeAction(){
        parent::beforeAction();
    }

    public function addUser()
    {
        $client_role_id = $this->user->getClientRoleId();
        //render the page
        Config::setJsConfig('curPage', "add-user");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/users/", Config::get('VIEWS_PATH') . 'user/addUser.php',
        [
            'page_title'        =>  'Add New User',
            'client_role_id'    =>  $client_role_id
        ]);
    }

    public function profile(){
        //data
        $info = $this->user->getProfileInfo(Session::getUserId());

        //render the page
        Config::setJsConfig('curPage', "profile");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/users/", Config::get('VIEWS_PATH') . 'user/profile.php',[
            'page_title'    =>  "User Profile",
            'info'          =>  $info
        ]);
    }

    public function editUserProfile(){
        if(!isset($this->request->params['args']['user']))
        {
            return $this->redirector->to("/site-settings/manage-users");
        }
        //data
        $info = $this->user->getProfileInfo($this->request->params['args']['user']);

        //render the page
        Config::setJsConfig('curPage', "edit-user-profile");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/users/", Config::get('VIEWS_PATH') . 'user/editUserProfile.php',[
            'page_title'    =>  "Edit User Profile",
            'info'          =>  $info
        ]);
    }

    public function isAuthorized(){
        return true;
        $role = Session::getUserRole();
        $action = $this->request->param('action');
        $resource = "user";
        // allow for admins
        Permission::allow(['super admin', 'admin'], $resource, ['*']);
        // remove other admins from users profile editing
        Permission::deny('admin', $resource, [
            'editUserProfile'
        ]);
        // allow everyone to edit their own profile
        Permission::allowAllRoles($resource,[
            'profile'
        ]);

        return Permission::check($role, $resource, $action);
    }
}
