<?php

/**
 * Styles controller
 *

 * @author     Mark Solly <mark.solly@fsg.com.au>
 */

class stylesController extends Controller
{
    public function beforeAction()
    {
        parent::beforeAction();
    }

    public function clientStyling()
    {
        $client_id =  0;
        $style_defaults = array(
            'logo'                      => '<img width="130" src="/images/FSG_logo@130px.png" class="custom-logo" alt="FSG" style="display:none;" title="WMS Home" /><img width="130" src="/images/FSG_logo_white@130px.png" class="custom-logo-transparent" alt="FSG logo" title="WMS Home" />',
            'card_border_colour'        => '#545380',
            'card_header_colour'        => '#4183C2',
            'card_header_background'    => 'rgba(180,195,220,0.1)',
            'card_header_border_colour' => '#545380'
        );
        $client_styles = $this->displaystyle->getClientStyles($client_id);
        $styles = (empty($client_styles))? $style_defaults: array_merge($style_defaults, $client_styles);
        $data = array(
            'client_id' => $client_id
        );
        $data = array_merge($data, $styles);
        //render the page
        Config::setJsConfig('curPage', "shipto-reps");
        $this->view->renderStyleSheet(Config::get('VIEWS_PATH') . "stylesheets/website-style.php",$data);
    }

    public function isAuthorized()
    {
        return true;
    }
}
?>