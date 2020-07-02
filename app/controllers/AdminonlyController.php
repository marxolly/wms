<?php

/**
 * Financials controller
 *

 * @author     Mark Solly <mark.solly@3plplus.com.au>
 */

class adminonlyController extends Controller
{
    public function beforeAction()
    {
        parent::beforeAction();
    }

    public function reeceDataTidy()
    {
        Config::setJsConfig('curPage', "reece-data-tidy");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/adminonly/", Config::get('VIEWS_PATH') . 'adminOnly/reeceDataTidy.php', [
            'page_title'    =>  "Check and Clean Reece Data"
        ]);
    }

    public function clientBayFixer()
    {
        $client_id = (isset($this->request->params['args']['client']))? $this->request->params['args']['client'] : 0;
        $client_name = $this->client->getClientName($client_id);
        $bays = $this->clientsbays->getCurrentBayUsage($client_id);
        Config::setJsConfig('curPage', "client-bay-fixer");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/adminonly/", Config::get('VIEWS_PATH') . 'adminOnly/clientBayFixer.php', [
            'page_title'    =>  "Client Bay Fixer",
            'client_name'   =>  $client_name,
            'client_id'     =>  $client_id,
            'bays'          =>  $bays
        ]);
    }

    public function dispatchedOrdersUpdater()
    {
        //echo "<pre>",print_r($this->request->params['args']),"</pre>";die();
        $client_name = "All Clients";
        $courier_id = -1;
        $client_id = 0;
        $fulfilled = 0;
        $state = "";
        if(!empty($this->request->params['args']))
        {
            if(isset($this->request->params['args']['client']))
            {
                $client_id = $this->request->params['args']['client'];
                $client_name = $this->client->getClientName($client_id);
            }
            if(isset($this->request->params['args']['courier']))
            {
                $courier_id = $this->request->params['args']['courier'];
            }
            if(isset($this->request->params['args']['state']))
            {
                $state = $this->request->params['args']['state'];
            }
        }
        $from = (isset($this->request->params['args']['from']))? $this->request->params['args']['from'] : strtotime('monday this week');
        $to = (isset($this->request->params['args']['to']))? $this->request->params['args']['to'] : time();
        $page_title = "Fulfilled Orders For $client_name";
        //$orders = $this->order->getUnfulfilledOrders($client_id, $courier_id, 0);     getAllOrders($client_id, $courier_id = -1, $fulfilled = 0, $store_order = -1)
        $orders = $this->order->getAllOrders($client_id, $courier_id, $fulfilled, 0, $state);
        //render the page
        Config::setJsConfig('curPage', "view-orders");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/orders/", Config::get('VIEWS_PATH') . 'adminOnly/viewOrders.php', [
            'page_title'    =>  $page_title,
            'client_name'   =>  $client_name,
            'client_id'     =>  $client_id,
            'courier_id'    =>  $courier_id,
            'orders'        =>  $orders,
            'fulfilled'     =>  $fulfilled,
            'state'         =>  $state,
            'from'          =>  $from,
            'to'            =>  $to,
            'date_filter'   =>  "Dispatched",
        ]);
    }

    public function eparcelShipmentDeleter()
    {
        $clients = $this->client->getEparcelClients();
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/reports/", Config::get('VIEWS_PATH') . 'adminOnly/eparcelShipmentsDeleter.php',[
            'page_title'    =>  "Deleting eParcel Shipments",
            'clients'       => $clients
        ]);
    }

    public function encryptSomeShit()
    {
        //encrypts passwords for storing in the config file
        Config::setJsConfig('curPage', "encrypt-some-shit");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/adminonly/", Config::get('VIEWS_PATH') . 'adminOnly/encryptsomeshit.php', [
            'page_title'    =>  "Encrypt Some Shit"
        ]);
    }

    public function updateConfiguration()
    {
        //add sensitive config data - passwords and keys data
        Config::setJsConfig('curPage', "update-configuration");
        $configuration_names = $this->configuration->getConfigurationNames();
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/adminonly/", Config::get('VIEWS_PATH') . 'adminOnly/updateConfiguration.php', [
            'page_title'            => "Configuration Update",
            'configuration_names'   => $configuration_names
        ]);
    }

    public function apiTester()
    {
        //up the memory for this
        ini_set('memory_limit', '2048M');
        //$freedomMYOB = $this->freedomMYOB;
        $encryptedData = $this->FreedomMYOB->callTask('getMYOBOrders',array());
        $invoices =  json_decode($this->FreedomMYOB->getDecryptedData($encryptedData),true);
        //echo "<pre>",print_r($invoices),"</pre>"; die();
        $orders = array();
        $errors = array();
        foreach($invoices as $inv)
        {
            //$address =str_replace("\r\n", "\n", $inv['ShipToAddress']);
            try{
                list($name, $line1, $line2, $line3) = explode("<br />", $inv['ShipToAddress']);
                echo "<p>Name: $name</p>";
                echo "<p>Line1: $line1</p>";
                echo "<p>Line2: $line2</p>";
                echo "<p>Line3: $line3</p>";
            }catch(Exception $e){
                echo "<p>Problem with ".$inv['ShipToAddress']."</p>";
            };

            continue;
            $ad = array();;
            $order = array(
                'client_id'             => 7,    //get this from DB in future
                'freedom_customer_id'   => $inv['Customer_UID'],
                'deliver_to'            => $inv['Customer_Name'],
                'tracking_email'        => $inv['Customer_Email'],
                'client_order_id'       => $inv['Invoice_Number'],
                'date_ordered'          => strtotime($inv['Date']),

            );
        }
        die();
        Config::setJsConfig('curPage', "api-tester");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/adminonly/", Config::get('VIEWS_PATH') . 'adminOnly/apiTester.php', [
            'page_title'            => "Test the APIs",
            'freedomMYOB'           => $this->FreedomMYOB
        ]);
    }

    public function sendTrackingEmails()
    {
        $db = Database::openConnection();
        $orders = $db->queryData("
            SELECT * FROM orders WHERE client_id = 6 AND date_fulfilled > 1541080800 AND store_order = 0 AND customer_emailed = 0
        ");
        foreach($orders as $o)
        {
            if( !empty($o['tracking_email']) )
            {
                //$this->output .= "Sending tracking email for {$od['order_number']}".PHP_EOL;
                echo "<p>Will send tracking email to {$o['tracking_email']}</p>";
                //$mailer->sendTrackingEmail($id);
                //Email::sendTrackingEmail($o['id']);
                $db->updateDatabaseField('orders', 'customer_emailed', 1, $o['id']);
            }
            else
            {
               echo "<p>No email for {$o['order_number']}</p>";
            }
        }
        echo "<pre>",print_r($orders),"</pre>";
    }

    public function isAuthorized(){
        $role = Session::getUserRole();
        if( $role === "super admin" )
        {
            return true;
        }
        return false;
    }
}
?>