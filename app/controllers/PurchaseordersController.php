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
        $error = false;
        $po_info = array();
        if(!isset($this->request->params['args']['po']))
        {
            //no purchase order id to update
            $error = "no_po_id";
        }
        $po_id = $this->request->params['args']['po'];
        $po_info = $this->purchaseorder->getPoById($po_id);
        if(empty($po_info))
        {
            //no purchase order data found
            $error = "no_po";
        }
        //render the page
        Config::setJsConfig('curPage', "view-update-purchase-order");
        Config::set('curPage', "view-update-purchase-order");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/purchaseorders/", Config::get('VIEWS_PATH') . 'purchaseorders/viewUpdatePO.php',
        [
            'po'            => $po_info,
            'page_title'    => "View Update Purchase Order",
            'pht'           => ": View Update Purchase Order",
            'error'         => $error
        ]);
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