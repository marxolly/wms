<?php

/**
 * Financials controller
 *

 * @author     Mark Solly <mark.solly@fsg.com.au>
 */

class DisplaySettingsController extends Controller
{
    public function beforeAction()
    {
        parent::beforeAction();
    }


    public function index()
    {
        //set the page name for menu display
        Config::setJsConfig('curPage', 'display-settings-index');
        parent::displayIndex(get_class());
    }

    public function isAuthorized(){
        $role = Session::getUserRole();
        $action = $this->request->param('action');
        $resource = "displaysettings";
        // only for super admins
        Permission::allow('client admin', $resource, ['*']);
        return Permission::check($role, $resource, $action);
    }
}
?>