<?php

/**
 * Purchase Orders controller
 *

 Manages Production Customers

 * @author     Mark Solly <mark.solly@fsg.com.au>
 */

class PurchaseOrdersController extends Controller
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

    public function addPurchaseOrder()
    {
        //render the page
        Config::setJsConfig('curPage', "add-purchase-order");
        Config::set('curPage', "add-purchase-order");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/purchaseorders/", Config::get('VIEWS_PATH') . 'purchaseorders/addPurchaseOrder.php', [
            'page_title'    =>  "Add Purchase Order",
            'pht'           =>  ": Add Purchase Order"
        ]);
    }

    public function viewUpdatePurchaseOrder()
    {
        
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