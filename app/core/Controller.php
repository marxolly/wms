<?php

/**
 * The controller class.
 *
 * The base controller for all other controllers.
 * Extend this for each created controller
 *
 
 * @author     Mark Solly <mark.solly@fsg.com.au>
 */

class Controller {

    /**
     * view
     *
     * @var View
     */
    protected $view;

    /**
     * request
     *
     * @var Request
     */
    public $request;

    /**
     * response
     *
     * @var Response
     */
    public $response;

    /**
     * redirector
     *
     * @var Redirector
     */
    public $redirector;

    /**
     * authorize for xero
     *
     * @var xero_auth
     */
    public $xero_auth;

    /**
     * loaded components
     *
     * @var array
     */
    public $components = [];

    public $page_title;

    public $Eparcel;

    public $MYOB;
    public $FreedomMYOB;

    public $woocommerce;

    public $directfreight;

    //public $shopify;

    public $squarespace;

    public $allocations;

    public $courierselector;

    public $orderfulfiller;

    public $formvalidator;

    public $ebayapi;

    /**
     * Constructor
     *
     * @param Request  $request
     * @param Response $response
    */
    public function __construct(Request $request = null, Response $response = null){

        $this->request             =  $request  !== null ? $request  : new Request();
        $this->response            =  $response !== null ? $response : new Response();
        //$this->xero_auth           =  new Xeroauth();
        $this->view                =  new View($this);
        $this->redirector          =  new Redirector();
        $this->woocommerce         =  new Woocommerce($this);
        $this->directfreight       =  new Directfreight($this);
        $this->allocations         =  new Allocations($this);
        $this->courierselector     =  new CourierSelector($this);
        $this->orderfulfiller      =  new OrderFulfiller($this);
        $this->emailordersparser   =  new EmailOrdersParser($this);
        $this->formvalidator       =  new FormValidator($this);
    }

    /**
     * Perform the startup process for this controller.
     * Events that that will be triggered for each controller:
     * 1. load components
     * 2. perform any logic before calling controller's action(method)
     * 3. trigger startup method of loaded components
     * 
     * @return void|Response
     */
    public function startupProcess(){

        $this->initialize();
        $this->loadCourierClasses();
        $this->loadFinancialClasses();
        $this->loadFTPClasses();
        $this->loadEBAYClasses();
        $this->loadShopifyClasses();
        $this->loadMarketplacerClasses();
        //$this->loadXeroClasses();

        $this->beforeAction();

        $result = $this->triggerComponents();
        //echo "<pre>",print_r($result),"</pre>";die();
        if($result instanceof Response){
            return $result;
        }
    }

    /**
     * Initialization method.
     * initialize components and optionally, assign configuration data
     *
     */
     public function initialize(){
        $this->loadComponents([
             'Auth' => [
                     'authenticate' => ['User'],
                     'authorize'    => ['Controller']
                 ],
             'Security'
        ]);
     }

    public function loadCourierClasses()
    {
        $this->loadEparcelLocations([
            'Freedom',
            'Nuchev',
            'TTAU',
            'Oneplate'
        ]);
    }

    public function loadFinancialClasses()
    {
        $this->loadMYOBInstances([
            'Freedom'
        ]);
    }

    public function loadFTPClasses()
    {
        $this->loadFTPInstances([
            'Bds'
        ]);
    }

    public function loadShopifyClasses()
    {
        $this->loadShopifyInstances([
            'BuzzBee',
            'PbaArccosGolf',
            'PbaHomeCourseGolf',
            'PbaPerfectPracticeGolf',
            'PbaRukketGolf',
            'PbaSuperspeedGolf',
            'PbaVoiceCaddy'
        ]);
    }

    public function loadMarketplacerClasses()
    {
        $this->loadMarketplacerInstances([
            'Nuchev'
        ]);
    }

    public function loadXeroClasses()
    {
        $this->loadXeroInstances([
            'PBA'
        ]);
    }

    public function loadEBAYClasses()
    {
        $this->loadEBAYInstances([
            'PBA'
        ]);
    }

    /**
     * Load the eParcel api location classes
     *
     * @param array $locations
     */
    public function loadEparcelLocations(array $locations)
    {
        $this->Eparcel = new Eparcel($this);
        foreach($locations as $location)
        {
            $class = $location . "Eparcel";
            $this->{$class} = new $class($this);
            $this->{$class}->init();
        }
    }

    /**
     * Load the MYOB api instance classes
     *
     * @param array $locations
     */
    public function loadMYOBInstances(array $locations)
    {
        $this->MYOB = new MYOB($this);
        foreach($locations as $location)
        {
            $class = $location . "MYOB";
            $this->{$class} = new $class($this);
            $this->{$class}->init();
        }
    }

    /**
     * Load any FTP instance classes
     *
     * @param array $locations
     */
    public function loadFTPInstances(array $locations)
    {
        $this->FTP = new FTP($this);
        foreach($locations as $location)
        {
            $class = $location . "FTP";
            $this->{$class} = new $class($this);
            $this->{$class}->init();
        }
    }

    /**
     * Load any Shopify instance classes
     *
     * @param array $locations
     */
    public function loadShopifyInstances(array $locations)
    {
        //$this->shopify =  new Shopify($this);
        foreach($locations as $location)
        {
            $class = $location . "Shopify";
            $this->{$class} = new $class($this);
            //$this->{$class}->init();
        }
    }

    /**
     * Load any Marketplacer instance classes
     *
     * @param array $locations
     */
    public function loadMarketplacerInstances(array $locations)
    {
        foreach($locations as $location)
        {
            $class = $location . "Marketplacer";
            $this->{$class} = new $class($this);
            //$this->{$class}->init();
        }
    }

    /**
     * Load any Xero instance classes
     *
     * @param array $locations
     */
    public function loadXeroInstances(array $locations)
    {
        foreach($locations as $location)
        {
            $class = $location . "Xero";
            $this->{$class} = new $class($this);
            //$this->{$class}->init();
        }
    }

    /**
     * Load any eBay instance classes
     *
     * @param array $locations
     */
    public function loadEBAYInstances(array $locations)
    {
        $this->ebayapi =  new EbayAPI($this);;
        foreach($locations as $location)
        {
            $class = $location . "eBay";
            $this->{$class} = new $class($this);
            //$this->{$class}->init();
        }
    }

    /**
     * load the components by setting the component's name to a controller's property.
     *
     * @param array $components
     */
    public function loadComponents(array $components){

        if(!empty($components)){

            $components = Utility::normalize($components);

            foreach($components as $component => $config){

                if(!in_array($component, $this->components, true)){
                    $this->components[] = $component;
                }

                $class = $component . "Component";
                $this->{$component} = empty($config)? new $class($this): new $class($this, $config);
            }
        }
    }
    
    /**
     * triggers component startup methods.
     * But, for auth, we are calling authentication and authorization separately
     *
     * You need to Fire the Components and Controller callbacks in the correct order,
     * For example, Authorization depends on form element, so you need to trigger Security first.
     *
     */
    private function triggerComponents(){

        // You need to Fire the Components and Controller callbacks in the correct orde
        // For example, Authorization depends on form element, so you need to trigger Security first.

        // We supposed to execute startup() method of each component,
        // but since we need to call Auth -> authenticate, then Security, Auth -> authorize separately

        // re-construct components in right order
        $components = ['Auth', 'Security'];
        foreach($components as $key => $component){
            if(!in_array($component, $this->components)){
                unset($components[$key]);
            }
        }

        $result = null;
        foreach($components as $component){

            if($component === "Auth"){

                $authenticate = $this->Auth->config("authenticate");
                if(!empty($authenticate)){
                    if(!$this->Auth->authenticate()){
                        $result = $this->Auth->unauthenticated();
                    }
                }

                // delay checking authorize till after the loop
                $authorize = $this->Auth->config("authorize");

            }else{
                $result = $this->{$component}->startup();
            }

            if($result instanceof Response){ return $result; }
        }

        // authorize
        if(!empty($authorize)){
            if(!$this->Auth->authorize()){
                $result = $this->Auth->unauthorized();
            }
        }

        return $result;
    }

    /**
     * show server error page
     *
     * @param int|string $code
     *
     */
    public function error($code){

        $errors = [
            404 => "notfound",
            401 => "unauthenticated",
            403 => "unauthorized",
            400 => "badrequest",
            500 => "system"
        ];

        if(!isset($errors[$code]) || !method_exists("ErrorsController", $errors[$code])){
            $code = 500;
        }

        $action = isset($errors[$code])? $errors[$code]: "System";
        $this->response->setStatusCode($code);

        // clear, get page, then send headers
        $this->response->clearBuffer();
        (new ErrorsController($this->request, $this->response))->{$action}();

        return $this->response;
    }

    /**
     * show site error page
     *
     * @param string $action
     *
     */
    public function siteError($action = false)
    {

        if(!$action || !method_exists("SiteErrorsController", $action))
            return (new ErrorsController())->error(500)->send();

        $this->response->setStatusCode(200);

        // clear, get page, then send headers
        $this->response->clearBuffer();
        (new SiteErrorsController($this->request, $this->response))->{$action}();

        return $this->response;
    }

    /**
     * Called before the controller action.
     * Used to perform logic that needs to happen before each controller action.
     *
     */
    public function beforeAction(){}

    /**
     * Magic accessor for model autoloading.
     *
     * @param  string $name Property name
     * @return object The model instance
     */
    public function __get($name) {
        return $this->loadModel($name);
    }

    /**
     * load model
     * It assumes the model's constructor doesn't need parameters for constructor
     *
     * @param string  $model class name
     */
    public function loadModel($model){
        $uc_model = ucwords($model);
        return $this->{$model} = new $uc_model();
    }

    /**
     * forces SSL request
     *
     * @see core/components/SecurityComponent::secureRequired()
     */
    public function forceSSL(){
        $secured  = "https://" . $this->request->fullUrlWithoutProtocol();
        return $this->redirector->to($secured);
    }

    /*******************************************************************
    ** validates empty data fields
    ********************************************************************/
	protected function dataSubbed($data)
	{
		if(!$data || strlen($data = trim($data)) == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}//end dataSubbed()

    function call_child_method($method, $args = "")
    {
        if(method_exists($this, $method))
        {
            $this->{$method}($args);
        }
    }

    /*******************************************************************
    ** Display the index page for the child classes
    ********************************************************************/
    public function displayIndex($child)
    {
        $app = new App();
        $names = Utility::splitCamelCase($child);
        array_pop($names);
        //echo "<pre>",print_r($names),"</pre>";die();
        //fix the child name
        $new_child = (ucwords(strtolower(implode("",$names))))."Controller";
        if(!$new_child || empty($new_child) || !$app::isControllerValid($new_child))
        {
            return (new ErrorsController())->error(404)->send();
        }
        $page_name = implode(" ",$names);
        $curPage = strtolower(str_replace(" ", "-", $page_name));
        //render the page
        //Config::setJsConfig('curPage', $curPage);
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/index/", Config::get('VIEWS_PATH') . 'index/controllerIndex.php', [
            'pht'           => ": ".$page_name,
            'page_title'    => $page_name." Pages",
            'page_name'     => $page_name
        ]);
    }

    /*******************************************************************
    ** Common Functions To Different Children
    ********************************************************************/
    public function manageDrivers($child)
    {
        $drivers = $this->driver->getDrivers();
        //render the page
        Config::setJsConfig('curPage', "drivers");
        Config::set('curPage', "drivers");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/sitesettings/", Config::get('VIEWS_PATH') . 'sitesettings/drivers.php',[
            'page_title'   =>  'Manage Drivers',
            'drivers'      =>  $drivers,
            'child'        =>  $child
        ]);
    }
}
