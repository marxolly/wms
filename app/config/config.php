<?php

 /**
  * This file contains configuration for the application.
  * It will be used by app/core/Config.php
  *
  * @author     Mark Solly <mark.solly@3plplus.com.au>
  */

return array(
    /**
     * Configuration for: Paths
     * Paths from App directory
     */
    "VIEWS_PATH"            => APP . "views/",
    "ERRORS_PATH"           => APP . "views/errors/",
    "LOGIN_PATH"            => APP . "views/login/",
    "ADMIN_VIEWS_PATH"      => APP . "views/admin/",
    "EMAIL_TEMPLATES_PATH"  => APP . "email_templates/",
    "EMAIL_ATTACHMENTS_PATH"  => APP . "email_attachments/",

    /**
     * Configuration for: Cookies
     *
     * COOKIE_RUNTIME: How long should a cookie be valid by seconds.
     *      - 1209600 means 2 weeks
     *      - 604800 means 1 week
     * COOKIE_DOMAIN: The domain where the cookie is valid for.
     *      COOKIE_DOMAIN mightn't work with "localhost", ".localhost", "127.0.0.1", or ".127.0.0.1". If so, leave it as empty string, false or null.
     *      @see http://stackoverflow.com/questions/1134290/cookies-on-localhost-with-explicit-domain
     *      @see http://php.net/manual/en/function.setcookie.php#73107
     *
     * COOKIE_PATH: The path where the cookie is valid for. If set to '/', the cookie will be available within the entire COOKIE_DOMAIN.
     * COOKIE_SECURE: If the cookie will be transferred through secured connection(SSL). It's highly recommended to set it to true if you have secured connection
     * COOKIE_HTTP: If set to true, Cookies that can't be accessed by JS - Highly recommended!
     * COOKIE_SECRET_KEY: A random value to make the cookie more secure. Now Stored in database
     *
     */
    "COOKIE_EXPIRY"         => 1209600,
    "SESSION_COOKIE_EXPIRY" => 604800,
    "COOKIE_DOMAIN"         => '',
    "COOKIE_PATH"           => '/',
    "COOKIE_SECURE"         => true,
    "COOKIE_HTTP"           => true,

    /**
     * Configuration for Email
     *
     */
    "EMAIL_FROM"        => "FSGWMS@fsg.com.au",
    "EMAIL_FROM_NAME"   => "Film Shot Graphics Warehouse Management System",
    "EMAIL_REPLY_TO"    => "FSGWMS@fsg.com.au",
    "EMAIl_HOST"        => "smtp.office365.com",
    "EMAIL_PORT"        => 587,

    "EMAIL_PASSWORD_RESET_URL" => PUBLIC_ROOT . "login/resetPassword",


    /**
     * Configuration for: Hashing strength
     *
     * It defines the strength of the password hashing/salting. "10" is the default value by PHP.
     * @see http://php.net/manual/en/function.password-hash.php
     *
     */
    "HASH_COST_FACTOR" => "10",

    /**
     * Configuration for: Pagination
     *
     */
    "PAGINATION_DEFAULT_LIMIT" => 10,

    /*************************************************************************
    * Max Shipping Price Allowed Without Checking
    **************************************************************************/
    'MAX_SHIPPING_CHARGE' => 80,

    /*************************************************************************
    * 3PL Address
    **************************************************************************/
    "THREEPL_ADDRESS" => array(
      	'address'	=>	'5 Mosrael Place',
		'address_2'	=>	'',
		'suburb'	=>	'Rowville',
		'city'		=>	'Melbourne',
		'state'		=>	'VIC',
		'country'	=>	'AU',
		'postcode'	=>	'3178'
	),
    /*************************************************************************
    * FSG Address
    **************************************************************************/
    "FSG_ADDRESS" => array(
        'address'	=>	'865 Mountain Hwy',
        'address_2'	=>	'',
        'suburb'	=>	'Bayswater',
        'city'		=>	'Melbourne',
        'state'		=>	'VIC',
        'country'	=>	'AU',
        'postcode'	=>	'3153'
    ),
    /*************************************************************************
    * Big Bottle Adventure Range
    **************************************************************************/
    "BB_ADRANGE_IDS" => array(
        11594,
        11595,
        11596,
        11597
    ),
    /*************************************************************************
    * Big Bottle 1.5L Range
    **************************************************************************/
    "BB_1.5L_IDS" => array(
        11768,
        11765,
        11767,
        11764,
        11769,
        11766
    ),
    /*************************************************************************
    * Big Bottle Weighted IDS
    **************************************************************************/
    "BB_WEIGHTED_IDS" => array(
        6067,   //big brush
        6040,   //royal chill
        6041,   //blush chill
        6042,    //plum chill
        6030,
        6031,
        10889
    ),
    /*************************************************************************
    * Big Bottle Boxes
    **************************************************************************/
    "BBBOX_WEIGHTS" => array(
        0,
        0.32,
        0.58,
        0.89,
        1.1,
        1.51,
        1.72,
        1.98,
        2.18,
        2.4,
        2.6,
        2.9,
        3,
        3.33,
        3.58,
        3.93,
        4.15,
        4.51,
        4.72,
        4.98,
        5.18,
        5.4,
        5.6,
        5.9,
        6
    ),
    "BBBOX_DIMENSIONS" => array(
        array(14,14,28),
        array(14,14,28),
        array(14,28,28),
        array(28,28,28),
        array(28,28,28),
        array(28,42,28),
        array(28,42,28),
        array(28,56,28),
        array(28,56,28),
        array(56,42,28),
        array(56,42,28),
        array(56,42,28),
        array(56,42,28),
        array(56,56,28),
        array(56,56,28),
        array(70,56,56),
        array(70,56,56)
    ),
    /*************************************************************************
    * Nuchev Boxes
    **************************************************************************/
    "nuchev1softbox" => array(
        'weight'        =>  0.24,
        'dimensions'    =>  array(14,14,19)
    ),
    "nuchev2softbox" => array(
        'weight'        =>  0.45,
        'dimensions'    =>  array(14,28,19)
    ),
    "nuchev3softbox" => array(
        'weight'        =>  0.77,
        'dimensions'    =>  array(15,42,20)
    ),
    "nuchev4softbox" => array(
        'weight'        =>  0.88,
        'dimensions'    =>  array(28,28,19)
    ),
    "nuchev6softbox" => array(
        'weight'        =>  1.26,
        'dimensions'    =>  array(40,28,19)
    ),

    "nuchev1box" => array(
        'weight'        =>  1.1,
        'dimensions'    =>  array(14,14,19)
    ),
    "nuchev2box" => array(
        'weight'        =>  2.1,
        'dimensions'    =>  array(14,28,19)
    ),
    "nuchev3box" => array(
        'weight'        =>  3.3,
        'dimensions'    =>  array(15,42,20)
    ),
    "nuchev4box" => array(
        'weight'        =>  4.2,
        'dimensions'    =>  array(28,28,19)
    ),
    "nuchev6box" => array(
        'weight'        =>  6.3,
        'dimensions'    =>  array(40,28,19)
    ),
    /*************************************************************************
    * Natural Distilling Boxes
    **************************************************************************/
    "NDC1box" => array(
        'weight'        => 1.8,
        'dimensions'    => array(28,14,14)
    ),
    "NDC2box" => array(
        'weight'        => 3.6,
        'dimensions'    => array(28,14,29)
    ),
    "NDC4box" => array(
        'weight'        => 7.2,
        'dimensions'    => array(28,29,29)
    ),
    /*************************************************************************
    * Hide Estimated Shipping Charge From
    **************************************************************************/
    "HIDE_CHARGE_CLIENTS"   =>  array(
        59, //noasleep
        69, //Team Timbuktu
        73, //Natural Distilling Co
    ),
    /*************************************************************************
    * Pages and icons
    **************************************************************************/
    "MENU_ICONS"    =>  array(
        'orders'            =>  'fas fa-truck',
        'ordering'          =>  'fas fa-cash-register',
		'clients'	        =>	'fas fa-user-tie',
		'products'	        =>	'fas fa-dolly',
		'inventory'	        =>	'fas fa-tasks',
		'reports'	        =>	'far fa-chart-bar',
		'site-settings'	    =>	'fas fa-cog',
		'staff'		        =>	'fas fa-users',
        'stock-movement'    =>  'fas fa-dolly',
        'data-entry'        =>  'fas fa-indent',
        'sales-reps'		=>	'fas fa-users',
        'solar-teams'		=>	'fas fa-users',
        'stores'            =>  'fas fa-store-alt',
        'downloads'         =>  'fas fa-download',
        'financials'        =>  'fas fa-file-invoice-dollar',
        'admin-only'        =>  'fas fa-lock',
        'scheduling'        =>  'far fa-calendar-alt',
        'solar-jobs'        =>  'fas fa-tools'
    ),
    "ADMIN_PAGES"   =>  array(
        'orders' => array(
            'add-order' =>  true,
            'add-bulk-orders'           =>  true,
            'order-update'			    => false,
			'process-backorders'	    =>	false,
			'order-summaries'		    =>	true,
            //'add-b2B-order'             =>  true,
            'edit-address'              =>  false,
            'order-edit'                =>  false,
            'edit-customer'             =>  false,
            'order-search'              =>  true,
            'order-search-results'      =>  false,
            //'order-picking'             =>  true,
            'order-details'             =>  false,
            //'order-packing'             =>  true,
            //'order-dispatching'         =>  true,
            //'truck-usage'               =>  true,
            'view-orders'               =>  true,
            'address-update'            =>  false,
            'items-update'              =>  false,
            'order-importing'           =>  true,
            //'view-storeorders'          => true,
            //'view-pickups'              => false,
            //'record-pickup'   => true,
            'order-csv-update'  => true,
            //'manage-swatches'   => true,
            //'add-serials'   => true
        ),
		'clients'	=> array(
			'view-clients'	=> true,
			'add-client'	=> true,
			'edit-client'	=> false,
		),
		'products'	=> array(
			'view-products'			=> true,
			'add-product'			=> true,
			'edit-product'			=> false,
			//'bulk-product-upload'	=>	true,
            'pack-items-edit'       =>  true,
            'collections-edit'      =>  true,
            'product-search'        =>  true,
		),
        'inventory'   =>  array(
            'view-inventory'		=>	true,
            'pack-items-manage'     =>  true,
            //'product-to-location'   =>  true,
            'scan-to-inventory'     =>  true,
            //'client-locations'      =>  true,
            'product-movement'      =>  false,
            //'location-scanner'      =>  true,
            //'returns-input'         =>  true,
            'goods-out'             =>  true,
            'goods-in'               =>  true,
            'add-subtract-stock'    =>  false,
            'quality-control'       =>  false,
            //'replenish-pickface'    => true,
            'transfer-location' => true,
            'solar-returns' => true,
            'move-bulk-items'   => true,
            'move-all-client-stock' => true
        ),
		'reports'			=> array(
          	//'product-movement-summary'	=>	true,
            //'product-by-location'   =>  true,
			'stock-movement-report'	=>	true,
			//'user-activity-report'		=>	true,
			//'client-activity-report'	=>	true,
			'dispatch-report'			=>	true,
			//'backorder-report'		=>	true,
			'inventory-report'			=>	true,
            'location-report'           =>  true,
			//'audit-log'				=>	true,
            'client-space-usage-report'   =>  true,
            //'hunters-check'             =>  true,
            //'client-daily-reports'      =>  true,
            'goods-out-report'          =>  true,
            'goods-out-summary'         =>  true,
            'goods-in-report'          =>  true,
            'goods-in-summary'         =>  true,
            //'staff-time-report'        =>  true,
            //'staff-time-sheets'         =>  true,
            //'eparcel-check'             =>  true,
            'stock-at-date'             =>  true,
            //'returns-report'             =>  true,
            //'empty-bay-report'           =>  true,
            //'pick-error-report'         =>  true,
            'unloaded-containers-report'       =>  true,
            'truck-run-sheet'       =>  true,
            '3pl-dispatch-report'   =>  false,
            '3pl-stock-movement-report' =>  false,
            'empty-bay-report'      => true,
            //'client-daily-reports'  => true,
            'pickups-report'    => true,
            'solar-returns-report'    => true,
            'solar-consumables-reorder' => true,
            'swatches-report'       => true,
            'order-serial-numbers-report'   => true,
            '3pl-order-serials-report'  => false
		),/*
        'sales-reps'        =>  array(
            'view-reps'                 =>  true,
            'add-sales-rep'             =>  true,
            'edit-sales-rep'            =>  false,
            'ship-to-reps'              =>  true
        ),
        'solar-teams'   =>array(
            'add-team'  => true,
            'edit-team' => false,
            'view-teams'    => true
        ),/*
        'stores'        =>  array(
            'view-stores'           =>  true,
            'add-store'             =>  true,
            'edit-store'            =>  false
        ),*/
        /*
        'staff'             => array(
            'time-sheets'   =>  true,
            'client-time-usage'  =>  true,
            'close-staff-task'  =>  false
        ),
        */
        'data-entry'    =>  array(
            'container-unloading'      => true,
            'error-data'                =>  true,
            'incoming-shipments'        =>  true
        ),
		'site-settings'		=> array(
			'order-status'				=> 	true,
			'stock-movement-reasons'	=> 	true,
            'locations'                 =>  true,
            'staff'                     =>  true,
            'manage-users'	            =>	true,
            'packing-types'             =>  true,
            //'store-chains'              =>  true,
            'user-roles'                =>  true,
            //'pickfaces'                 => true,
            'couriers'                  => true,
            'edit-user-profile'         => false,
            'add-user'                  => false
		),
        'financials'    =>  array(
            //'hunters-check' => true,
            'directfreight-check'   => true
        ),
        'downloads' => array(
            'super_admin_only'  => true,
            'print-location-barcodes'   => true,
            'useful-barcodes'   => true
        ),
        'admin-only'    => array(
            'super_admin_only'  => true,
            'eparcel-shipment-deleter'  => true,
            'dispatched-orders-updater' => false,
            'client-bay-fixer'  => true,
            'encrypt-some-shit' => false,
            'update-configuration'  => true
        ),
    ),
    'WAREHOUSE_PAGES' => array(
        'orders'      => array(
            'order-picking'     =>  true,
            'order-packing'     =>  true,
            'order-dispatching'         =>  true,
            'view-orders'               =>  true,
            'order-search'              =>  true,
            'order-search-results'      =>  false,
        ),
        'products'    =>  array(
            'view-products'			=> true,
            'add-product'           =>  true,
            'edit-product'			=> false,
             'product-search'        =>  true,

        ),
        'inventory'     =>  array(
            'view-inventory'		=>	true,
            'product-to-location'   =>  true,
            'scan-to-inventory'     =>  true,
            //'client-locations'      =>  true,
            'product-movement'      =>  false,
            'goods-out'             =>  true,
            'goods-in'               =>  true,
            'add-subtract-stock'    =>  false,
            'quality-control'       =>  false,
            'pack-items-manage'     =>  true,
            //'replenish-pickface'    => true
        ),
        'staff'   =>  array(
            'time-sheets'   =>  true,
            'client-time-usage'  =>  true
        )
    ),
    'CLIENT_PAGES' => array(
        'orders'			=>	array(
			'client-orders'		=>	true,
			'order-detail'	    =>	false,
			'order-tracking'	=>	false,
            'add-order'         =>  true,
            'bulk-upload-orders'     =>  true,
            //'book-pickup'       => true,
            //'add-origin-order'  => true
		),
		'inventory'			=>	array(
			'client-inventory'	=>	true,
            'expected-shipments'    =>  true,
            'register-new-stock'    => true
		),
        'reports'           =>  array(
            'dispatch-report'   =>  true,
            'stock-at-date'             =>  true ,
            'returns-report'             =>  true,
            'stock-movement-report'     =>  true,
            'stock-movement-summary'    =>  true,
            'client-dispatch-report'    =>  false,
            'client-stock-movement-report'  =>  false
        )
    ),
    /**
    * Order status
    *
    */

);
