<?php

/**
 * Site Errors controller
 *
 * Used for App Errors generated by non supplied or bad database IDS
 *
 * Site Errors controller can be only accessed from within the application itself,
 * So, any request that has errors as controller will be considered as invalid
 *
 * @see App::isControllerValid()
 *

 * @author     Mark Solly <mark.solly@fsg.com.au>
 */

class SiteErrorsController extends Controller{

    /**
     * Initialization method.
     *
     */
    public function initialize(){
    }

    public function noPickupId()
    {
        //render the error page
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('ERRORS_PATH') . 'noPickupId.php', [
            'pht'   => ": No Pickup ID"
        ]);
    }

    public function noPickupFound()
    {
        //render the error page
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('ERRORS_PATH') . 'noPickupFound.php', [
            'pht'   => ": No Pickup Found"
        ]);
    }

    public function noJobId()
    {
        //render the error page
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('VIEWS_PATH') . 'errors/noJobId.php', [
            'pht'   => ": No Job ID"
        ]);
    }

    public function noJobFound()
    {
        //render the error page
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('VIEWS_PATH') . 'errors/noJobFound.php', [
            'pht'   => ": No Job Found"
        ]);
    }

    public function noShipmentId()
    {
        //render the error page
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('VIEWS_PATH') . 'errors/noShipmentId.php', [
            'pht'   => ": No Shipment ID"
        ]);
    }

    public function noShipmentFound()
    {
        //render the error page
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('VIEWS_PATH') . 'errors/noShipmentFound.php', [
            'pht'   => ": No Shipment Found"
        ]);
    }
}
