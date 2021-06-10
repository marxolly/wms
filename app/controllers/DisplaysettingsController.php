<?php

/**
 * Display Settings - client admins only controller
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

    public function adjustColours()
    {
        if( !Session::getUserRole() == "client admin" )
        {
            return $this->error(403);
        }
        $client_id = Session::getUserClientId();
        $client_name = $this->client->getClientName($client_id);
        Config::setJsConfig('curPage', "adjust-colours");
        Config::set('curPage', "adjust-colours");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/displaysettings/", Config::get('VIEWS_PATH') . 'displaysettings/adjustColours.php',[
            'page_title'        =>  ucwords(strtolower($client_name)).' Colour Settings',
            'client_id'         =>  $client_id,
            'client_name'       =>  $client_name
        ]);
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