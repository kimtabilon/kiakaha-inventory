<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Kiakaha Inv',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b></b>Inventory',

    'logo_mini' => '<b>I</b>nv',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'purple',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Widgets
    |--------------------------------------------------------------------------
    |
    | Choose a widget for your admin panel.
    |
    */

    'widget' => [
        'message'       => false,
        'notification'  => false,
        'task'          => false,
        'user'          => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'dashboard',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'MAIN NAVIGATION',
        [
            'text' => 'Dashboard',
            'url'  => 'dashboard',
            'icon' => 'dashboard',
        ],
        [
            'text' => 'Inventory',
            'url'  => 'inventories',
            'icon' => 'th',
            'url'  => 'inventories',
            'can'  => 'manager-receiving-coordinator-access',
            // 'label'       => 4,
            // 'label_color' => 'success',
            // 'can'     => 'manager-receiving-coordinator-access',
            'submenu' => [
                [
                    'text' => 'For Review',
                    'url'  => 'inventories#for-review',
                    'can'  => 'receiving-coordinator-access',
                    'icon_color' => 'green',
                    'icon' => 'flag-checkered',
                ],
                [
                    'text' => 'Under Repair',
                    'url'  => 'inventories#under-repair',
                    'can'  => 'receiving-coordinator-access',
                    'icon_color' => 'aqua',
                ],
                [
                    'text' => 'For Approval',
                    'can'  => 'manager-access',
                    'url'  => '#',
                    'icon_color' => 'aqua',
                    'icon' => 'flag-checkered',
                    'submenu' => [
                        [
                            'text' => 'For Floor Item',
                            'url'  => 'inventories#for-approval',
                            'icon' => 'plus',
                        ],
                        [
                            'text' => 'For Transfer',
                            'url'  => 'inventories#for-transfer',
                            'icon' => 'share-square-o',
                        ],
                        [
                            'text' => 'For Disposal',
                            'url'  => 'inventories#for-disposal',
                            'icon' => 'trash',
                        ],
                    ],
                ],
                [
                    'text' => 'Good',
                    'url'  => 'inventories#good',
                    'icon' => 'check-square-o',
                    'icon_color' => 'green',
                    'can'  => 'manager-access',
                ],
                [
                    'text' => 'Sold',
                    'url'  => 'inventories#sold',
                    'can'  => 'manager-access',
                    'icon' => 'shopping-cart',
                    'icon_color' => 'yellow',
                ],
                [
                    'text' => 'Transferred',
                    'can'  => 'manager-access',
                    'icon' => 'share-square-o',
                    'url'  => 'inventories#transferred',
                ],
                [
                    'text' => 'Disposed',
                    'can'  => 'manager-access',
                    'icon' => 'trash',
                    'url'  => 'inventories#disposed',
                ],
                [
                    'text' => 'Refunded',
                    'url'  => 'inventories#refunded',
                    'can'  => 'manager-access',
                    'icon' => 'arrow-circle-right',
                ],
                [
                    'text' => 'Returned',
                    'url'  => 'inventories#returned',
                    'can'  => 'manager-access',
                    'icon' => 'exchange',
                    'icon_color' => 'red',
                ],
            ],
        ],
        [
            'text' => 'Transaction',
            'url'  => 'transactions',
            'icon' => 'share-alt',
            'can'  => 'manager-receiving-coordinator-access',
        ],
        [
            'text' => 'Transaction',
            'url'  => 'cashier',
            'icon' => 'share-alt',
            'can'  => 'cashier-access',
        ],
        [
            'text'    => 'Item',
            'url'     => '#',
            'icon'    => 'files-o',
            'url'     => 'items',
            'can'  => 'manager-receiving-coordinator-access',
            // 'label'       => 4,
            // 'label_color' => 'success',
            // 'can'     => 'manager-receiving-coordinator-access',
            'submenu' => [
                [
                    'text' => 'List',
                    'url'  => 'items',
                    'icon' => 'list-alt',
                    'icon_color' => 'green',
                ],
                [
                    'text' => 'Image',
                    'url'  => 'items/images',
                    'icon' => 'file-o',
                    'icon_color' => 'yellow',
                ],
                /*[
                    'text' => 'Discount',
                    'url'  => 'items/discounts',
                    'icon' => 'edit',
                    'icon_color' => 'aqua',
                ],*/
            ],
        ],
        [
            'text' => 'Customer',
            'url'  => 'customers',
            'icon' => 'users',
            'can'  => 'manager-access',
        ],

        'ACCOUNTS',
        /*[
            'text' => 'Profile',
            'url'  => 'profile',
            'icon' => 'lock',
        ],*/
        [
            'text' => 'User',
            'url'  => 'users',
            'icon' => 'user',
            'can'  => 'manager-access',
        ],
        'QUICK ACCESS',
        [
            'text'       => 'Good Item',
            'url'        => 'inventories#good',
            'icon_color' => 'green',
            'can'  => 'manager-access',
        ],
        [
            'text'       => 'Sold Item',
            'url'        => 'inventories#sold',
            'icon_color' => 'yellow',
            'can'  => 'manager-access',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => false,
    ],
];
