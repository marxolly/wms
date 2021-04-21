<?php

/**
 * Purchase Orders controller
 *

 Manages Production Customers

 * @author     Mark Solly <mark.solly@fsg.com.au>
 */

class PurchaseordersController extends Controller
{
    public function beforeAction()
    {
        parent::beforeAction();
        $this->Security->config("form", [ 'fields' => ['csrf_token']]);
    }

    public function index()
    {
        //set the page name for menu display
        Config::setJsConfig('curPage', 'purchase-orders-index');
        parent::displayIndex(get_class());
    }


    public function isAuthorized()
    {
        $action = $this->request->param('action');
        $role = Session::getUserRole();
        //$role = (Session::isAdminUser())? 'admin' : Session::getUserRole();
        $resource = "purchaseorders";

        //only for production admin and production sales admin
        Permission::allow(['production sales admin', 'production admin'], $resource, "*");
        return Permission::check($role, $resource, $action);
    }
}