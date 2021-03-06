<?php

/**
 * The Eparcel class.
 *
 * The base class for all Eparcel location classes.
 * It provides reusable controller logic.
 * The extending classes can be used as part of the controller.
 *
 
 * @author     Mark Solly <mark.solly@fsg.com.au>
 */
 class Eparcel{

    public $controller;
    protected $API_KEY;
    protected $API_PWD ;
    protected $ACCOUNT_NO;
    protected $from_address_array;

    const    API_SCHEME   = 'https://';
    const    API_HOST     = 'digitalapi.auspost.com.au';
    const    API_PORT     = 443;                            // ssl port
    //const    API_BASE_URL = '/test/shipping/v1/';         // for production use, remove '/test'
    const    API_BASE_URL = '/shipping/v1/';                // for production use, remove '/test'
    const   HEADER_EOL = "\r\n";

    private $fSock;         // socket handle


    public function __construct(Controller $controller)
    {
        $this->controller   = $controller;
        $this->API_KEY      = Config::get('EPARCEL_API_KEY');
        $this->API_PWD      = Config::get('EPARCEL_API_PWD');
        $this->ACCOUNT_NO   = Config::get('EPARCEL_ACCOUNT_NO');

        $from_address = Config::get("FSG_ADDRESS");
        $this->from_address_array = array(
            'name'      =>  'FSG Print and 3PL',
            'lines'		=>	array($from_address['address']),
            'suburb'	=>	$from_address['suburb'],
            'postcode'	=>	$from_address['postcode'],
            'state'		=>	$from_address['state'],
            'country'	=>  $from_address['country']
        );
    }

    protected function createSocket()
    {
        $i_timeout = 15;        // seconds
        if ( ($this->fSock = fsockopen( Eparcel::API_SCHEME . Eparcel::API_HOST, Eparcel::API_PORT, $errno, $errstr, $i_timeout) ) === false )
        {
            return (new ErrorsController())->error(500);
        }
    }

    protected function buildHttpHeaders($s_type,$s_action,$n_content_len = 0,$b_incl_accno = false)
    {
        $a_headers   = array();
        $a_headers[] = $s_type . ' ' . Eparcel::API_BASE_URL . $s_action . ' HTTP/1.1';
        $a_headers[] = 'Authorization: ' . 'Basic ' . base64_encode($this->API_KEY . ':' . $this->API_PWD);
        $a_headers[] = 'Host: ' . Eparcel::API_HOST;
        if ($n_content_len) {
            $a_headers[] = 'Content-Type: application/json';
            $a_headers[] = 'Content-Length: ' .
                           $n_content_len;     /* Content-Length is a mandatory header field to avoid HTTP 500 errors */
        }
        $a_headers[] = 'Accept: */*';
        if ($b_incl_accno) {
            $a_headers[] = 'Account-Number: ' . $this->ACCOUNT_NO;
        }
        $a_headers[] = 'Cache-Control: no-cache';
        $a_headers[] = 'Connection: close';
        return $a_headers;
    }

    protected function sendGetRequest($s_action)
    {
        $url = Eparcel::API_SCHEME . Eparcel::API_HOST . Eparcel::API_BASE_URL . $s_action;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        //curl_setopt($ch, CURLOPT_TIMEOUT, 30);  auspost response is really f**ken slow!
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_USERPWD, $this->API_KEY . ":" . $this->API_PWD);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Basic '. base64_encode($this->API_KEY . ":" . $this->API_PWD),
            'account-number: '.$this->ACCOUNT_NO)
        );
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if ($err)
        {
            die('Could not write to Eparcel API '.$err);
        }
        else
        {
            return $result;
        }
    }

    protected function sendPostRequest($s_action, $a_data)
    {
        $data_string = json_encode($a_data);
        //echo $data_string; //die();
        $url = eParcel::API_SCHEME . eParcel::API_HOST . eParcel::API_BASE_URL . $s_action;
        //echo $url;
        //echo "<p>Account ".$this->ACCOUNT_NO."</p>";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        //curl_setopt($ch, CURLOPT_TIMEOUT, 30);  auspost response is really f**ken slow!
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_USERPWD, $this->API_KEY . ":" . $this->API_PWD);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string),
            'Authorization: Basic '. base64_encode($this->API_KEY . ":" . $this->API_PWD),
            'account-number: '.$this->ACCOUNT_NO)
        );
        $result = curl_exec($ch);
        //echo "<pre>",print_r($result),"</pre>"; die();
        $err = curl_error($ch);
        curl_close($ch);
        if ($err)
        {
            die('Could not write to eParcel API '.$err);
        }
        else
        {
            return $result;
        }
    }

    protected function sendPutRequest($s_action,$a_data)
    {
       $data_string = json_encode($a_data);
        //echo $data_string;
        $url = eParcel::API_SCHEME . eParcel::API_HOST . eParcel::API_BASE_URL . $s_action;
        //echo $url;
        //echo $this->ACCOUNT_NO;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        //curl_setopt($ch, CURLOPT_TIMEOUT, 30);  auspost response is really f**ken slow!
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_USERPWD, $this->API_KEY . ":" . $this->API_PWD);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string),
            'Authorization: Basic '. base64_encode($this->API_KEY . ":" . $this->API_PWD),
            'account-number: '.$this->ACCOUNT_NO)
        );
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if ($err)
        {
            die('Could not write to eParcel API '.$err);
        }
        else
        {
            return $result;
        }
    }

    protected function sendDeleteRequest($s_action)
    {
        $url = eParcel::API_SCHEME . eParcel::API_HOST . eParcel::API_BASE_URL . $s_action;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        //curl_setopt($ch, CURLOPT_TIMEOUT, 30);  auspost response is really f**ken slow!
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_USERPWD, $this->API_KEY . ":" . $this->API_PWD);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            //'Content-Length: ' . strlen($data_string),
            'Authorization: Basic '. base64_encode($this->API_KEY . ":" . $this->API_PWD),
            'account-number: '.$this->ACCOUNT_NO)
        );
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if ($err)
        {
            die('Could not write to eParcel API '.$err);
        }
        else
        {
            return $result;
        }
    }

    public function GetAccountDetails()
    {
        $response = $this->sendGetRequest('accounts/' . $this->ACCOUNT_NO);
        return json_decode($response, true);
    }

    public function CreateShipments($a_shipments)
    {
        $response = $this->sendPostRequest('shipments', $a_shipments);
        //print_r($response);
        return json_decode($response, true);
    }

    public function DeleteShipment($shipment_id)
    {
        $response = $this->sendDeleteRequest('shipments?shipment_ids='.$shipment_id);
        return json_decode($response, true);
    }

    public function CreateLabels($a_labels)
    {

        $response = $this->sendPostRequest('labels',$a_labels);
        return json_decode($response, true);
    }

    public function GetLabel($request_id)
    {
    	$response = $this->sendGetRequest('labels/' . $request_id);
        return json_decode($response, true);
    }

    public function GetItemPrices($a_items)
    {
        $response = $this->sendPostRequest('prices/items',$a_items);
        return json_decode($response, true);
    }

    public function CreateOrderFromShipment($a_shipmentorder)
    {
        //echo "REQUEST<pre>",print_r(json_encode($a_shipmentorder)),"</pre>";
        $response = $this->sendPutRequest('orders',$a_shipmentorder);
        //echo "RESPONSE<pre>",print_r($response),"</pre>"; die();
        return json_decode($response, true);
    }

    public function UpdateShipment($a_shipment, $shipment_id)
    {
        $response = $this->sendPutRequest('shipments/'.$shipment_id, $a_shipment);
        return json_decode($response, true);
    }

    public function GetOrderSummary($order_id, $ship_id)
    {
        $today = date('YMd');
        $response = $this->sendGetRequest('accounts/' . $this->ACCOUNT_NO. '/orders/' . $order_id . '/summary');
        //file_put_contents(PUBLIC_ROOT.'eparcel_orders/order_summary'.$today.'.pdf', $response);
        $this->controller->eparcelorder->addSummary($response, $ship_id);
        //echo json_decode($response, true);
    }

    public function GetTracking($conid)
    {
        $response = $this->sendGetRequest('track/' . $conid);
        return json_decode($response, true);
    }

    public function ValidateSuburb($suburb = null, $state = null, $postcode = null)
    {
        $response = $this->sendGetRequest('address?suburb='. rawurlencode($suburb) .'&state='. rawurlencode($state) .'&postcode=' . rawurlencode($postcode));
        return json_decode($response, true);
    }

    public function GetAPIKey()
    {
        return $this->API_KEY;
    }

    public function GetAPISecret()
    {
        return $this->API_PWD;
    }

    public function GetShipments($from = 0, $to = 200, $params = array())
    {
        $query_string = 'offset='.$from.'&number_of_shipments='.$to;
        foreach($params as $key => $value)
        {
            $query_string .= '&'.$key.'='.$value;
        }
        $response = $this->sendGetRequest('shipments?'.$query_string);
        return json_decode($response, true);
    }

    public function GetShipment($id)
    {
        $response = $this->sendGetRequest('shipments/'.$id);
        return json_decode($response, true);
    }

    public function GetQuote($a_shipments)
    {
        $response = $this->sendPostRequest('prices/shipments', $a_shipments);
        return json_decode($response, true);
    }

    public function getShipmentDetails($od, $items, $use_express = false)
    {
        $express = ($od['eparcel_express'] == 1);

        if(!$express)
        {
            $express = $use_express;
        }
        $order_id = $od['id'];
        $ad = array(
            'address'   =>  $od['address'],
            'address_2' =>  $od['address_2'],
            'state'     =>  $od['state'],
            'suburb'    =>  $od['suburb'],
            'postcode'  =>  $od['postcode'],
            'country'   =>  $od['country'],
            'phone'     =>  $od['contact_phone']
        );
        //$items = $this->controller->order->getItemsForOrder($order_id);
        $delivery_instructions = (!empty($od['instructions']))? $od['instructions'] : "Please leave in a safe place out of the weather";
        if(empty($od['ref_1']))
        {
            $ref_1 = strtoupper(str_replace(" ", "", $this->controller->client->getClientName($od['client_id'])));
        }
        else
        {
            $ref_1 = $od['ref_1'];
        }
        if($od['signature_req'] == 1)
            $delivery_instructions = (!empty($od['instructions']))? $od['instructions'] : "";
        $shipment = array(
            'shipment_reference'		=> 	$order_id,
            'email_tracking_enabled'	=>	!is_null($od['tracking_email']),
            'from'						=>	array(),
            'to'						=>	array(),
            'items'						=>	array(),
            "sender_references"			=>	array($ref_1, $od['order_number']),

        );
        $shipment['to'] = array(
    		'name'	   				=>	$od['ship_to'],
    		'lines'					=>	array(),
    		'suburb'				=>	trim($od['suburb']),
    		'postcode'				=>	trim($od['postcode']),
    		'state'					=>	trim($od['state']),
            'country'				=>	trim($od['country']),
            'delivery_instructions'	=>	$delivery_instructions
    	);
        if(!empty($od['company_name'])) $shipment['to']['business_name'] = $od['company_name'];
        if(!empty($od['tracking_email'])) $shipment['to']['email'] = $od['tracking_email'];
        if(!empty($od['contact_phone'])) $shipment['to']['phone'] = $od['contact_phone'];
        $shipment['to']['lines'][] = $od['address'];
        if(!empty($od['address_2'])) $shipment['to']['lines'][] = $od['address_2'];
        /*
        $fsg_address = Config::get("FSG_ADDRESS");
        $shipment['from'] = array(
            'name'      =>  'Murphy Bros Printing Pty Ltd',
            'lines'		=>	array($fsg_address['address']),
            'suburb'	=>	$fsg_address['suburb'],
            'postcode'	=>	$fsg_address['postcode'],
            'state'		=>	$fsg_address['state'],
            'country'	=>  $fsg_address['country']
        );
        */
        $shipment['from'] = $this->from_address_array;
        $packages = $this->controller->order->getPackagesForOrder($order_id);
        $weight = 0;
        $val = 0;
        $contains_dangerous_goods = false;
        foreach($items as $i)
        {
            if($i['is_dangerous_good'] == 1)
                $contains_dangerous_goods = true;
            $ival = ($i['price'] == 0)? $i['qty'] : $i['price'] * $i['qty'];
            if($od['client_id'] == 6 && $ad['country'] != "AU")
                    $ival = $i['qty'] * 1.81;
            $val += $ival;
        }
        $parcels = Packaging::getPackingForOrder($od,$items,$packages, $val);
        foreach($parcels as $p)
        {
            $c = 1;
            while($c <= $p['pieces'])
            {
                $array = array();
                if($ad['country'] == "AU")
                {
                   	$array['authority_to_leave'] = ($od['signature_req'] == 0);
                }
                else
                {
                    $array['commercial_value'] = false;
                    $array['classification_type'] = 'GIFT';
                    if($ad['country'] == "CA")
                        $array['classification_type'] = 'SAMPLE';
                }
                $array['item_reference'] = $p['item_reference'];
                $array['product_id'] = $this->getEparcelChargeCode($ad, $p['weight'], $express);
                $array['width'] = $p['width'];
                $array['height'] = $p['height'];
                $array['length'] = $p['depth'];
                $array['weight'] = $p['weight'];
                $array['contains_dangerous_goods'] = $contains_dangerous_goods;
                
                $array['item_contents'] = array();
                if($ad['country'] != "AU")
                {
                    $pval = round( $val/count($parcels) , 2);
                    if(empty($this->controller->client->getProductsDescription($od['client_id'])))
                    {
                        if(empty($items[0]['description']))
                        {
                            $description = $items[0]['name'];
                        }
                        else
                        {
                            $description = $items[0]['description'];
                        }
                    }
                    else
                    {
                        $description = $this->controller->client->getProductsDescription($od['client_id']);
                    }
                    $array['item_contents'][] = array(
                        'description'   =>  $description,
                        'value'         =>  $pval,
                        'quantity'      =>  1
                    );
                }
                $shipment['items'][] = $array;
                ++$c;
            }
        }

        return $shipment;
    }

    /*
    protected function getEparcelChargeCode($ad, $weight = 0, $expresspost = false)
    {
        if($expresspost)
        {
            return '3J85';
        }
        return '3D85';
    }
    */
    protected function getEparcelChargeCode($ad, $weight = 0, $expresspost = false)
    {
        //return "7E55";
        $pti8_countries = array(
            "BE",
            "CA",
            "CN",
            "HR",
            "DK",
            "EE",
            "FR",
            "DE",
            "HK",
            "HU",
            "IE",
            "IL",
            "LT",
            "MY",
            "MT",
            "NL",
            "NZ",
            "PL",
            "PT",
            "SG",
            "SI",
            "ES",
            "SE",
            "GB",
            "US"
        );
        if($ad['country'] == "AU")
        {
            if($expresspost) return '3J85';
            return '3D85';
        }
        else
        {
            //if( $weight > 22 || !in_array($ad['country'], $pti8_countries) )
            //return 'AIR8';
            //return 'PTI7'; //signature
            //return 'PTI8'; //no signature
            //return 'ECM8';
            //if($weight < 2)
                //return 'RPI8';    auspost covid cancelled the economy fares
            return 'PTI7';
        }
    }

}
