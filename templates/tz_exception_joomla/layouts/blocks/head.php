<?php

// This is the code which will be placed in the head section

// No direct access.
defined('_JEXEC') or die;
?>
<?php if ($this->browser->get('browser') == 'ie8' || $this->browser->get('browser') == 'ie7' || $this->browser->get('browser') == 'ie6') : ?>
    <meta http-equiv="X-UA-Compatible" content="IE=9">
<?php endif; ?>
<?php if ($this->getParam("chrome_frame_support", '0') == '1' && ($this->browser->get('browser') == 'ie8' || $this->browser->get('browser') == 'ie7' || $this->browser->get('browser') == 'ie6')) : ?>
    <meta http-equiv="X-UA-Compatible" content="chrome=1"/>
<?php endif; ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="HandheldFriendly" content="true"/>
<meta name="apple-mobile-web-app-capable" content="YES"/>
<?php
//
$doc = JFactory::getDocument();
// PLAZART BASE HEAD
$this->addHead();
// generate the max-width rules
$max_page_width = $this->getParam('max_page_width', 0);

$theme = $this->getParam('theme', 'default');
$css_custom = '';
if ($max_page_width) {

//    $css_custom .= ('.container-fluid { max-width: ' . $this->getParam('max_page_width', '1200') . $this->getParam('max_page_width_value', 'px') . '!important; } .container { max-width: ' . $this->getParam('max_page_width', '1200') . $this->getParam('max_page_width_value', 'px') . '!important; }');
}
if ($this->getParam('boxes_temp') == 1) {
    $css_custom .= ('body > *{ max-width:' . $this->getParam('max_page_width', '1200') . $this->getParam('max_page_width_value', 'px') . '!important; margin: auto;}
                     body { background:url("' . JUri::base() . $this->getParam('background_body') . '") repeat scroll 0 0 #333;}
                     .head-style3 #tz-top-bar-1.top-bar {  border-radius: 10px 0 0 0; }
                     .head-style3 #tz-top-bar-2.top-bar {  border-radius: 0 10px 0 0; }
                     .top-head.sticky{max-width: 100% !important;  transition: none;}
                     .login-box .container, #home_content_portfolio .container{width:100%;}
                     .close-login{right : 0;}
                   ');
}

// CSS override on two methods
if ($this->getParam("css_override", '0')) {
    $this->addCSS('override', false);
}
//var_dump($this->getParam('css_custom'));
$css_custom .= ($this->getParam('css_custom', ''));
//if (trim($css_custom)) {
//    if (!$this->addExtraCSS($css_custom, 'custom')) $this->addStyleDeclaration($css_custom);;
//}

// load prefixer
if ($this->getParam("css_prefixer", '0')) {
    $this->addScript(PLAZART_TEMPLATE_REL . '/libraries/js/prefixfree.js');
}

// load lazyload
if ($this->getParam("js_lazyload", '0')) {
    $this->addScript(PLAZART_TEMPLATE_REL . '/libraries/js/jquery.lazyload.min.js');
}
$this->addScript(PLAZART_TEMPLATE_REL . '/js/jquery.nicescroll.min.js');
$this->addScript(PLAZART_TEMPLATE_REL . '/js/jquery.prettyPhoto.js');
$this->addScript(PLAZART_TEMPLATE_REL . '/js/jquery.nav.js');
$this->addScript(PLAZART_TEMPLATE_REL . '/js/jquery.totemticker.min.js');
$this->addScript(PLAZART_TEMPLATE_REL . '/js/waypoints.min.js');
$this->addScript(PLAZART_TEMPLATE_REL . '/js/jquery.animateNumber.min.js');
$this->addScript(PLAZART_TEMPLATE_REL . '/js/jquery.easypiechart.min.js');
$this->addScript(PLAZART_TEMPLATE_REL . '/js/jquery.sharrre.min.js');
$this->addScript(PLAZART_TEMPLATE_REL . '/js/page.js');
$this->addScript(PLAZART_TEMPLATE_REL . '/js/main.js');

if ($this->getParam('dark_light') == 1):
    $doc->addStyleSheet(PLAZART_TEMPLATE_REL . '/css/themes/' . $theme . '/dark.css');
else:
    $doc->addStyleSheet(PLAZART_TEMPLATE_REL . '/css/themes/' . $theme . '/light.css');
endif;
if ($this->getParam('rtl') == 1):
    $doc->addStyleSheet(PLAZART_TEMPLATE_REL . '/css/themes/' . $theme . '/rtl.css');
endif;

?>

<!--[if IE 9]>
<link rel="stylesheet" href="<?php echo PLAZART_TEMPLATE_REL.'/css/'.$theme; ?>/ie9.css" type="text/css"/>
<![endif]-->

<!--[if IE 8]>
<link rel="stylesheet" href="<?php echo PLAZART_TEMPLATE_REL.'/css/'.$theme; ?>/ie8.css" type="text/css"/>
<![endif]-->

<!--[if lte IE 7]>
<link rel="stylesheet" href="<?php echo PLAZART_TEMPLATE_REL.'/css/'.$theme; ?>/css/ie7.css" type="text/css"/>
<script src="<?php echo PLAZART_TEMPLATE_REL.'/js/icon-font-ie7.js'; ?>"></script>
<![endif]-->

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- For IE6-8 support of media query -->
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo PLAZART_URL ?>/js/respond.min.js"></script>
<![endif]-->
<?php
$global_color1 = $this->getParam('global_color1');
$topBar_color_text = $this->getParam('top_bar_color');
$topBar_color_border = $this->getParam('top_bar_color_border');
$global_color_border = $this->getParam('global_color_border');
$menu_color_text = $this->getParam('menu_color_text');
$menu_color_text_active = $this->getParam('menu_color_text_active');
$menu_color_text_hover = $this->getParam('menu_color_text_hover');
$menu_color_bg_hover = $this->getParam('menu_color_bg_hover');
$menu_color_bg_active = $this->getParam('menu_color_bg_active');
$menu_color_bg = $this->getParam('menu_color_bg');

$submenu_color_bg_hover = $this->getParam('submenu_color_bg_hover');
$submenu_color_border = $this->getParam('submenu_color_border');
$submenu_color_text = $this->getParam('submenu_color_text');
$submenu_color_text_hover = $this->getParam('submenu_color_text_hover');
$global_bg1 = $this->getParam('global_bg1');
$global_color2 = $this->getParam('global_color2');
$submenu_color_bg = $this->getParam('submenu_color_bg');
$submenu_color_bg_active = $this->getParam('submenu_color_bg_active');
$submenu_color_text_active = $this->getParam('submenu_color_text_active');

function hex2rgba($color, $opacity = false)
{

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if (empty($color))
        return $default;

    //Sanitize $color if "#" is provided
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb = array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if ($opacity) {
        if (abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
    }

    //Return rgb(angel) color string
    return $output;
}


if ($this->getParam('devmode')) {
    if ($global_color1) {
        $doc->addStyleDeclaration('
            .footer-top .footer-menu a:hover:before,.footer-top .footer-menu a:hover,.footer-top .tweet a:hover,
            .custom ul li a:hover,.custom ul li a:focus
            .team-box:hover:after,.team-box-2:hover:after,
            .responsive-nav,
            .search-box:before,
            .block-head:before,.block-head:after,
            .widget-head:before,.widget-head:after,
            .details-img:after,
            .post-image:after,
            .team-box:after,.team-box-2:after,
            .item-box:after,.team-box .team-socials li a:hover,
            .service-box-1:after,
            .portfolio-item:after,
            .caption.main-color,
            .main-color,a, .top-search a,
            .hr-style4:after,.hr-style4:before,
            .block-head,.widget-head,
            footer a:hover,
            .title-2 .breadcrumbs a,.title-3 .breadcrumbs a,.title-4 .breadcrumbs a,.footer-top a:hover:before,
            .list.prim li:before,
            #filters li a,
            .team-box-2 .t-position,.team-box-2 .team-socials a,
            .author-name,.add-items i.fa,.copyrights b,
            .dark-bg .btn-large:before,.box-top .more-btn,
            .service-box-1:hover a,.box-top i.fa,
            .item-box:hover .item-tools i,.item-cart a:hover,
            .main-border,.btn.main-border,
            .fun-title, .staff-1 .fun-icon,
            .project-name,.slick-dots li.slick-active button:before,
            .title-1 h1,.list.alt li:before,.product-price,.title-2 h1,.main-title,
            .accordion li.active a,.accordion li > h3 i.fa,
            .post-info h2 a:hover,.siteMap-nav ul ul li a:hover,
            .head2-lft-links li i,.item-tools i,
            .product-specs a.btn.selected,
            .widget-content a:hover,
            .copyrights a:hover,
            #tz_append .mess a {
                color: ' . $global_color1 . ';
            }

            #filter >a.btn:hover,
            #filter >a.btn.selected {
                background-color:' . $global_color1 . '!important;
            }
            .block-head-News:hover .icon,
            .table-style2 th,
            .list-footer .pagination ul li:hover,
            .list-footer .pagination ul li.active{
             background-color:' . $global_color1 . ';
            }

            .item-box:hover:after,
            .item-box:hover .item-price,
            .team-box:hover:after,
            .team-box-2:hover:after,
            .item-price,
            .item-box:hover .item-price,
            .item-box:hover .item-title{
                background-color:' . $global_color1 . ';
            }
            .block-head-News a span,

            .btn.empty.main-border,
            .TzIcon .btn-group.pull-right .dropdown-menu li a,
            .TzIcon .btn-group.pull-right .dropdown-toggle,
            .item-cart-product .add-on a,
            .left .add-cart:hover{
                color:' . $global_color1 . ';
            }
            hr:before, hr:after,
            .service-box-5 a, .service-box-4 a,
            .service-box-2:hover .box-2-cont >i ,
            .service-box-2:hover .box-2-cont >a ,
            .service-box-3:hover .box-head > i,
            .service-box-3:hover > a.r-more{
                 background-color:' . $global_color1 . ';
            }

            .flex-direction-nav li .flex-prev:hover,.flex-direction-nav li .flex-next:hover,
            .plan-year:after,.tabs > ul li:hover, .tabs > ul li.active,
            .btn.main-bg,.top-search.selected a,.top-search a:hover,
            #filters li.active,#filters li:hover,
            .accordion li.active h3 u,.search-w .btn.main-bg,
            .team-boxes-2 .cell-3:hover .team-box-2,
            .team-box .team-details,.team-box:hover .team-details,
            .portfolio-item:hover:after,.tp-arr-allwrapper:hover,
            .main-bg,.footer .NL .NL-btn:hover,
            #to-top,.social-list li a:hover,
            .footer-top .tags a:hover,.level-in,
            .service-box-1:hover,.service-box-1:hover .box-top,
            .slick-prev:hover,.slick-next:hover,
            .team-box:hover:after,.team-box-2:hover:after,
            .responsive-nav,.search-box:before,
            .block-head:before,.block-head:after,
            .widget-head:before,.widget-head:after,
            .details-img:after,.post-image:after,
            .team-box:after,.team-box-2:after,
            .item-box:after,.service-box-1:after,
            .portfolio-item:after{
                background-color:' . $global_color1 . ';
            }
            .view-all-projects a:hover,
            .tz_slideshow .flex-control-paging li a.flex-active,
            .icon-cont{
                background-color:' . $global_color1 . ';
            }
            .tri-col, .icon-cont:after{
                border-color:' . $global_color1 . ' transparent transparent;
            }
            .view-all-projects a{
            color: ' . $global_color1 . ';
            }
            .Newsslider,
            .icon-middle, .product-img li a.active img{
                    border-color:' . $global_color1 . ';
            }
            blockquote{
                border-left-color:' . $global_color1 . '
            }

            .level-in:before{
                border-color:transparent transparent transparent ' . $global_color1 . ';
            }
            .btn.empty.main-border,
            .item-box:hover .item-title,
            .tabs-pane,
            .accordion li.active h3 u,
            .accordion li.active h3 a,
            .clients > div a:hover,
            .auto-clients > div a
            {
                border-color: ' . $global_color1 . ' !important;
            }
            .bg-slide-new:before,
            section.our-plan:before,
            .flickr-stream-w .img-overlay{
                background-color:' . hex2rgba($global_color1, 0.7) . ';
            }

            .post-image a .mask{
                background-color:' . hex2rgba($global_color1, 0.5) . ';
            }
            .tri-col{
                border-color: ' . $global_color1 . ' transparent transparent;
            }
            .Newsslider .slick-prev:hover, .Newsslider .slick-next:hover,
            .pagin.pager li:hover,
            .pagin.pager li.active{
                 background-color:' . $global_color1 . ';
            }
            .hikashop_product_price_main .item-price .hikashop_product_price{
                 color:' . $global_color1 . ';
            }
        ');
    }

    if ($global_color2) {
        $doc->addStyleDeclaration('
            .share-post ul li a:hover,
            .comment-reply.main-bg:hover,
            .btn.main-bg:hover,
            .search .btn.main-bg:hover,
            .registration .btn.main-bg:hover,
            .oe-pricing-foot .btn.main-bg:hover,
            .pricing-footer .btn.main-bg:hover,
            .team-box .team-socials li a{
                background-color: ' . $global_color2 . ';
            }
            a.read-more:hover,
            .TzIcon .btn-group.pull-right .dropdown-menu li:hover a{
                color: ' . $global_color2 . ';
            }
            #hikashop_add_wishlist.wishlist_product > a:hover{
               color: ' . $global_color2 . ';
            }
        ');
    }

    if ($global_bg1) {
        $doc->addStyleDeclaration('
            .img-over a.link,
            .block-bg-1:before,
            .block-bg-2:before,
            .block-bg-3:before,
            .block-bg-4:before,
            .block-bg-5:before{
                background-color: ' . hex2rgba($global_bg1, 0.7) . ';
            }
        ');
    }

    if ($topBar_color_text) {
        $doc->addStyleDeclaration('
            .cart_items .hikashop_cart,.top-bar a, .top-bar span{
                color: ' . $topBar_color_text . ' !important;
            }
        ');
    }
    if ($topBar_color_border) {
        $doc->addStyleDeclaration('
            .top-bar li,.cart_items .hikashop_cart_module{
                border-color: ' . $topBar_color_border . ' !important;
            }
        ');
    }
    if ($global_color_border) {
        $doc->addStyleDeclaration('
            .contact-form input[type="text"]:focus,
            .contact-form input[type="password"]:focus,
            .contact-form input[type="email"]:focus,
            .contact-form textarea:focus,
            .pricing-table.selected, .cart-popup{
                border-color: ' . $global_color_border . ' !important;
            }
        ');
    }
    if ($menu_color_text) {
        $doc->addStyleDeclaration('
            .menuBtn i,
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li > a i,
            #off-canvas-nav .title_menu,
            .sticky .top-nav ul.level0 > li > a,
            .plazart-megamenu .navbar-nav > li > a{
                color:  #ffffff !important;
            }

        ');
    }
    if ($menu_color_text_active) {
        $doc->addStyleDeclaration('
            #plazart-mainnav .plazart-megamenu ul.level0.navbar-nav > li.dropdown.active > a,
            #plazart-mainnav .plazart-megamenu ul.level0.navbar-nav > li.open.dropdown.active > a,
            #plazart-mainnav .plazart-megamenu ul.level0.navbar-nav > li.dropdown.active > a > i{
                color: ' . $menu_color_text_active . '!important;
            }
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li.active > a,
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li.active > a > i{
                color: ' . $menu_color_text_active . '!important;
            }
        ');
    }
    if ($menu_color_text_hover) {
        $doc->addStyleDeclaration('
            #plazart-mainnav ul.level0 > li:hover > a,
            #plazart-mainnav ul.level0 > li > a:hover,
            #plazart-mainnav ul.level0 > li:hover > a i,
            #plazart-mainnav ul.level0 > li > a:hover i,
            #plazart-mainnav .mega-menu .nav li.dropdown.open > .dropdown-toggle,
            #plazart-mainnav .mega-menu .nav li.dropdown.active > .dropdown-toggle,
            #plazart-mainnav .mega-menu .nav li.dropdown.open.active > .dropdown-toggle,
            #plazart-mainnav .mega-menu .nav > li.dropdown.open.active > a:hover,
            #plazart-mainnav .nav-2 .nav li.dropdown.open > .dropdown-toggle,
            #plazart-mainnav .nav-2 .nav li.dropdown.active > .dropdown-toggle,
            #plazart-mainnav .nav-2 .nav li.dropdown.open.active > .dropdown-toggle,
            #plazart-mainnav .nav-2 .nav > li.dropdown.open.active > a:hover,
            .top-nav ul li.open a i{
                color: ' . $menu_color_text_hover . ' !important;
            }
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li > a:hover i,
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li > a:hover{
                color: ' . $menu_color_text_hover . ' !important;
            }
        ');
    }
    if ($menu_color_bg_hover) {
        $doc->addStyleDeclaration('
            .head-style2 #plazart-mainnav .top-nav .nav.level0 > li.open,
            .head-style2 #plazart-mainnav .top-nav .nav.level0 > li:hover,
            #plazart-mainnav .nav > li:hover > a,
            #plazart-mainnav .mega-menu .nav li.dropdown.open > .dropdown-toggle,
            #plazart-mainnav .nav > li > a:hover{
                background-color: ' . $menu_color_bg_hover . ';
            }

            .head-style3 #plazart-mainnav .nav > li > a:hover,
            .head-style3 #plazart-mainnav .nav > li.open > a{
                background-color: ' . $menu_color_bg_hover . ' !important;
            }
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li.open:hover > a,
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li > a:hover {
                background-color: ' . $menu_color_bg_hover . ' !important;
            }
        ');
    }
    if ($menu_color_bg_active) {
        $doc->addStyleDeclaration('
            .head-style2 #plazart-mainnav .top-nav .nav.level0 > li.active,
            #plazart-mainnav .mega-menu .nav li.dropdown.active > .dropdown-toggle,
            #plazart-mainnav .mega-menu .nav li.dropdown.open.active > .dropdown-toggle,
            #plazart-mainnav .mega-menu .nav > li.dropdown.open.active > a:hover,
            #plazart-mainnav .nav-2 .nav li.dropdown.open > .dropdown-toggle,
            #plazart-mainnav .nav-2 .nav li.dropdown.active > .dropdown-toggle,
            #plazart-mainnav .nav-2 .nav li.dropdown.open.active > .dropdown-toggle,
            #plazart-mainnav .nav-2 .nav > li.dropdown.open.active > a:hover{
                background-color: ' . $menu_color_bg_active . ';
            }
            #plazart-mainnav .plazart-megamenu ul.level0.navbar-nav > li.dropdown.active > a,
            #plazart-mainnav .plazart-megamenu ul.level0.navbar-nav > li.open.dropdown.active > a,
            #plazart-mainnav .plazart-megamenu ul.level0.navbar-nav > li.dropdown.active > a > i{
                background-color: ' . $menu_color_bg_active . ' !important;
            }

            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li.active{
                background-color: ' . $menu_color_bg_active . ' !important;
            }
        ');
    }
    if ($menu_color_bg) {
        $doc->addStyleDeclaration('
            #plazart-mainnav .mega-menu.top-nav ul.level0 > li.active:after,
            #plazart-mainnav .mega-menu.top-nav ul.level0 > li:hover:after,
            #plazart-mainnav .nav-2.top-nav ul.level0 > li.active:after,
            #plazart-mainnav .nav-2.top-nav ul.level0 > li:hover:after{
                background-color: ' . $menu_color_bg . ';
            }
        ');
    }
    if ($submenu_color_bg) {
        $doc->addStyleDeclaration('
            .head-style3 #plazart-mainnav .dropdown-menu li > a,
            #plazart-mainnav .mega-menu.top-nav li li > a,
            #plazart-mainnav .nav-2.top-nav li li > a,
            #plazart-mainnav .dropdown-menu li > a{
                background-color: ' . $submenu_color_bg . ';
            }
            #plazart-mainnav ul.level0 .new_sub .nav-child{
                background-color: ' . $submenu_color_bg . '!important;
            }
             #off-canvas-nav .plazart-mainnav ul li li{
                background-color: ' . $submenu_color_bg . ';
            }
        ');
    }
    if ($submenu_color_bg_hover) {
        $doc->addStyleDeclaration('
            #plazart-mainnav .dropdown-menu li > a:hover,
            #plazart-mainnav .dropdown-menu li > a:focus,
            #plazart-mainnav .dropdown-submenu:hover > a,
            #plazart-mainnav .dropdown-submenu.open > a,
            #plazart-mainnav .mega-menu.top-nav li li:hover > a,
            #plazart-mainnav .nav-2.top-nav li li:hover > a{
                background-color: ' . $submenu_color_bg_hover . ';
            }

            .head-style3 #plazart-mainnav .dropdown-menu li.open > a,
            .head-style3 #plazart-mainnav .dropdown-menu li > a:hover{
                background-color: ' . $submenu_color_bg_hover . ';
            }
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li ul > li.open:hover > a,
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li ul > li > a:hover{
                background-color: ' . $submenu_color_bg_hover . '!important;
            }

        ');
    }
    if ($submenu_color_bg_active) {
        $doc->addStyleDeclaration('
            #plazart-mainnav .mega-menu.top-nav li li.active > a,
            #plazart-mainnav .nav-2.top-nav li li.active > a,
            #plazart-mainnav .nav-2.top-nav li li.active:hover > a,
            #plazart-mainnav .nav-2.top-nav li li.active.open > a,
            #plazart-mainnav .dropdown-menu .active > a,
            #plazart-mainnav .dropdown-menu .active > a:hover
            {
                background-color: ' . $submenu_color_bg_active . ';
            }
            .head-style3 #plazart-mainnav .dropdown-menu li.active > a{
                background-color: ' . $submenu_color_bg_active . ' !important;
            }
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li ul > li.current.active a{
                background-color: ' . $submenu_color_bg_active . ' !important;
            }
        ');
    }

    if ($submenu_color_text) {
        $doc->addStyleDeclaration('
            .head-style3 #plazart-mainnav .dropdown-menu li > a,
            .head-style3 #plazart-mainnav .dropdown-menu li.dropdown-submenu:after,
            #plazart-mainnav .dropdown-menu li > a,
            .top-nav li li.dropdown-submenu:after
            {
                color: ' . $submenu_color_text . ';
            }
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li ul > li a{
                color: ' . $submenu_color_text . ';
            }
        ');
    }

    if ($submenu_color_text_active) {
        $doc->addStyleDeclaration('
            #plazart-mainnav .mega-menu.top-nav li li.active:hover > a,
            #plazart-mainnav .nav-2.top-nav li li.active:hover > a,
            #plazart-mainnav .mega-menu.top-nav li li.active > a,
            #plazart-mainnav .nav-2.top-nav li li.active > a,
            .top-nav li li.dropdown-submenu.active:after,
            #plazart-mainnav .top-nav li li.dropdown-submenu.active > a
            #plazart-mainnav .dropdown-menu .active > a,
            #plazart-mainnav .dropdown-menu .active > a:hover{
                color: ' . $submenu_color_text_active . ' !important;
            }

            #plazart-mainnav ul.level0 li li.active.dropdown-submenu:hover:after,
            #plazart-mainnav ul.level0 li li.active.open > a,
            #plazart-mainnav ul.level0 li li.active > a{
                color: ' . $submenu_color_text_active . ' !important;
            }

            .head-style3 #plazart-mainnav .dropdown-menu li.active > a:hover{
                color: ' . $submenu_color_text_active . ' !important;
            }
            .head-style3 #plazart-mainnav .dropdown-menu li.active.dropdown-submenu:after{
                color: ' . $submenu_color_text_active . ';
            }
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li ul > li.current.active a{
                color: ' . $submenu_color_text_active . ';
            }
        ');
    }

    if ($submenu_color_text_hover) {
        $doc->addStyleDeclaration('
            #plazart-mainnav ul.level0 li li.open > a,
            #plazart-mainnav ul.level0 li li > a:hover,
            #plazart-mainnav .mega-menu.top-nav li li:hover > a,
             #plazart-mainnav .nav-2.top-nav li li:hover > a,
            .top-nav li li.dropdown-submenu:hover:after,
            .top-nav li li.dropdown-submenu:hover > a{
                color: ' . $submenu_color_text_hover . ' !important;
            }

            .head-style3 #plazart-mainnav .dropdown-menu li > a:hover{
                color: ' . $submenu_color_text_hover . ' !important;
            }
             #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li ul > li a:hover{
                color: ' . $submenu_color_text_hover . ' !important;
            }
        ');
    }
} else {
    if ($global_color1) {
        $css_custom .= '
            .footer-top .footer-menu a:hover:before,.footer-top .footer-menu a:hover,.footer-top .tweet a:hover,
            .custom ul li a:hover,.custom ul li a:focus
            .team-box:hover:after,.team-box-2:hover:after,
            .responsive-nav,.search-box:before,
            .block-head:before,.block-head:after,
            .widget-head:before,.widget-head:after,
            .details-img:after,.post-image:after,
            .team-box:after,.team-box-2:after,
            .item-box:after,.team-box .team-socials li a:hover,
            .service-box-1:after,.portfolio-item:after,
            .caption.main-color,.main-color,a, .top-search a,
            .hr-style4:after,.hr-style4:before,
            .block-head,.widget-head,
            footer a:hover,
            .title-2 .breadcrumbs a,.title-3 .breadcrumbs a,.title-4 .breadcrumbs a,
            .footer-top a:hover:before,.list.prim li:before,
            #filters li a,.team-box-2 .t-position,.team-box-2 .team-socials a,
            .author-name,.add-items i.fa,.copyrights b,.dark-bg .btn-large:before,
            .box-top .more-btn,
            .service-box-1:hover a,.box-top i.fa,
            .item-box:hover .item-tools i,.item-cart a:hover,
            .main-border,.btn.main-border,
            .fun-title, .staff-1 .fun-icon,
            .project-name,.slick-dots li.slick-active button:before,
            .title-1 h1,.list.alt li:before,
            .product-price,.title-2 h1,
            .main-title,
            .accordion li.active a,.accordion li > h3 i.fa,
            .post-info h2 a:hover,.siteMap-nav ul ul li a:hover,
            .head2-lft-links li i,
            .item-tools i,.product-specs a.btn.selected,
            .widget-content a:hover,.copyrights a:hover,
            #tz_append .mess a {
                color: ' . $global_color1 . ';
            }

            #filter >a.btn:hover,
            #filter >a.btn.selected {
                background-color:' . $global_color1 . '!important;
            }
            .block-head-News:hover .icon,
            .table-style2 th,
            .list-footer .pagination ul li:hover,
            .list-footer .pagination ul li.active{
             background-color:' . $global_color1 . ';
            }

            .item-box:hover:after,
            .item-box:hover .item-price,
            .team-box:hover:after,
            .team-box-2:hover:after,
            .item-price,
            .item-box:hover .item-price,
            .item-box:hover .item-title{
                background-color:' . $global_color1 . ';
            }
            .block-head-News a span,

            .btn.empty.main-border,
            .TzIcon .btn-group.pull-right .dropdown-menu li a,
            .TzIcon .btn-group.pull-right .dropdown-toggle,
            .item-cart-product .add-on a,
            .left .add-cart:hover{
                color:' . $global_color1 . ';
            }
            hr:before, hr:after,
            .service-box-5 a, .service-box-4 a,
            .service-box-2:hover .box-2-cont >i ,
            .service-box-2:hover .box-2-cont >a ,
            .service-box-3:hover .box-head > i,
            .service-box-3:hover > a.r-more{
                 background-color:' . $global_color1 . ';
            }

            .flex-direction-nav li .flex-prev:hover,.flex-direction-nav li .flex-next:hover,
            .plan-year:after,.tabs > ul li:hover, .tabs > ul li.active,
            .btn.main-bg,.top-search.selected a,.top-search a:hover,
            #filters li.active,#filters li:hover,
            .accordion li.active h3 u,.search-w .btn.main-bg,
            .team-boxes-2 .cell-3:hover .team-box-2,
            .team-box .team-details,.team-box:hover .team-details,
            .portfolio-item:hover:after,.tp-arr-allwrapper:hover,
            .main-bg,.footer .NL .NL-btn:hover,
            #to-top,.social-list li a:hover,
            .footer-top .tags a:hover,
            .level-in,.service-box-1:hover,.service-box-1:hover .box-top,
            .slick-prev:hover,.slick-next:hover,
            .team-box:hover:after,.team-box-2:hover:after,
            .responsive-nav,.search-box:before,
            .block-head:before,.block-head:after,
            .widget-head:before,.widget-head:after,
            .details-img:after,.post-image:after,
            .team-box:after,.team-box-2:after,
            .item-box:after,.service-box-1:after,
            .portfolio-item:after{
                background-color:' . $global_color1 . ';
            }
            .view-all-projects a:hover,
            .tz_slideshow .flex-control-paging li a.flex-active,
            .icon-cont{
                background-color:' . $global_color1 . ';
            }
            .tri-col, .icon-cont:after{
                border-color:' . $global_color1 . ' transparent transparent;
            }
            .view-all-projects a{
            color: ' . $global_color1 . ';
            }
            .Newsslider,
            .icon-middle, .product-img li a.active img{
                    border-color:' . $global_color1 . ';
            }
            blockquote{
                border-left-color:' . $global_color1 . '
            }

            .level-in:before{
                border-color:transparent transparent transparent ' . $global_color1 . ';
            }
            .btn.empty.main-border,
            .item-box:hover .item-title,
            .tabs-pane,
            .accordion li.active h3 u,
            .accordion li.active h3 a,
            .clients > div a:hover,
            .auto-clients > div a
            {
                border-color: ' . $global_color1 . ' !important;
            }
            .bg-slide-new:before,
            section.our-plan:before,
            .flickr-stream-w .img-overlay{
                background-color:' . hex2rgba($global_color1, 0.7) . ';
            }

            .post-image a .mask{
                background-color:' . hex2rgba($global_color1, 0.5) . ';
            }
            .tri-col{
                border-color: ' . $global_color1 . ' transparent transparent;
            }
            .Newsslider .slick-prev:hover, .Newsslider .slick-next:hover,
            .pagin.pager li:hover,
            .pagin.pager li.active{
                 background-color:' . $global_color1 . ';
            }
             .hikashop_product_price_main .item-price .hikashop_product_price{
                 color:' . $global_color1 . ';
            }
        ';
    }

    if ($global_color2) {
        $css_custom .= '
            .share-post ul li a:hover,
            .comment-reply.main-bg:hover,
            .btn.main-bg:hover,
            .search .btn.main-bg:hover,
            .registration .btn.main-bg:hover,
            .oe-pricing-foot .btn.main-bg:hover,
            .pricing-footer .btn.main-bg:hover,
            .team-box .team-socials li a{
                background-color: ' . $global_color2 . ';
            }

            a.read-more:hover,
            .TzIcon .btn-group.pull-right .dropdown-menu li:hover a{
                color: ' . $global_color2 . ';
            }
             #hikashop_add_wishlist.wishlist_product > a:hover{
               color: ' . $global_color2 . ';
            }
        ';
    }

    if ($global_bg1) {
        $css_custom .= '
            .img-over a.link,
            .block-bg-1:before,
            .block-bg-2:before,
            .block-bg-3:before,
            .block-bg-4:before,
            .block-bg-5:before{
                background-color: ' . hex2rgba($global_bg1, 0.7) . ';
            }
        ';
    }

    if ($topBar_color_text) {
        $css_custom .= '
            .cart_items .hikashop_cart,.top-bar a, .top-bar span{
                color: ' . $topBar_color_text . ' !important;
            }
        ';
    }
    if ($topBar_color_border) {
        $css_custom .= '
            .top-bar li,.cart_items .hikashop_cart_module{
                border-color: ' . $topBar_color_border . ' !important;
            }
        ';
    }
    if ($global_color_border) {
        $css_custom .= '
            .contact-form input[type="text"]:focus,
            .contact-form input[type="password"]:focus,
            .contact-form input[type="email"]:focus,
            .contact-form textarea:focus,
            .pricing-table.selected, .cart-popup{
                border-color: ' . $global_color_border . ' !important;
            }
        ';
    }
    if ($menu_color_text) {
        $css_custom .= '
            .sticky .top-nav ul.level0 > li > a,
            .plazart-megamenu .navbar-nav > li > a{
                color: ' . $menu_color_text . '!important;
            }
        ';
    }
    if ($menu_color_text_active) {
        $css_custom .= '
            #plazart-mainnav .plazart-megamenu ul.level0.navbar-nav > li.dropdown.active > a,
            #plazart-mainnav .plazart-megamenu ul.level0.navbar-nav > li.open.dropdown.active > a,
            #plazart-mainnav .plazart-megamenu ul.level0.navbar-nav > li.dropdown.active > a > i{
                color: ' . $menu_color_text_active . '!important;
            }
              #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li.active > a,
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li.active > a > i{
                color: ' . $menu_color_text_active . '!important;
            }
        ';

    }
    if ($menu_color_text_hover) {
        $css_custom .= '
            #plazart-mainnav ul.level0 > li:hover > a,
            #plazart-mainnav ul.level0 > li > a:hover,
            #plazart-mainnav ul.level0 > li:hover > a i,
            #plazart-mainnav ul.level0 > li > a:hover i,
            #plazart-mainnav .mega-menu .nav li.dropdown.open > .dropdown-toggle,
            #plazart-mainnav .mega-menu .nav li.dropdown.active > .dropdown-toggle,
            #plazart-mainnav .mega-menu .nav li.dropdown.open.active > .dropdown-toggle,
            #plazart-mainnav .mega-menu .nav > li.dropdown.open.active > a:hover,
            #plazart-mainnav .nav-2 .nav li.dropdown.open > .dropdown-toggle,
            #plazart-mainnav .nav-2 .nav li.dropdown.active > .dropdown-toggle,
            #plazart-mainnav .nav-2 .nav li.dropdown.open.active > .dropdown-toggle,
            #plazart-mainnav .nav-2 .nav > li.dropdown.open.active > a:hover,
            .top-nav ul li.open a i{
                color: ' . $menu_color_text_hover . ' !important;
            }
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li > a:hover i,
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li > a:hover{
                color: ' . $menu_color_text_hover . ' !important;
            }
        ';
    }
    if ($menu_color_bg_hover) {
        $css_custom .= '
            .head-style2 #plazart-mainnav .top-nav .nav.level0 > li.open,
            .head-style2 #plazart-mainnav .top-nav .nav.level0 > li:hover,
            #plazart-mainnav .nav > li:hover > a,
            #plazart-mainnav .mega-menu .nav li.dropdown.open > .dropdown-toggle,
            #plazart-mainnav .nav > li > a:hover
            {
                background-color: ' . $menu_color_bg_hover . ';
            }

            .head-style3 #plazart-mainnav .nav > li > a:hover,
            .head-style3 #plazart-mainnav .nav > li.open > a{
                background-color: ' . $menu_color_bg_hover . ' !important;
            }
             #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li.open:hover > a,
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li > a:hover {
                background-color: ' . $menu_color_bg_hover . ' !important;
            }
        ';
    }
    if ($menu_color_bg_active) {
        $css_custom .= '
            .head-style2 #plazart-mainnav .top-nav .nav.level0 > li.active,
            #plazart-mainnav .mega-menu .nav li.dropdown.active > .dropdown-toggle,
            #plazart-mainnav .mega-menu .nav li.dropdown.open.active > .dropdown-toggle,
            #plazart-mainnav .mega-menu .nav > li.dropdown.open.active > a:hover,
            #plazart-mainnav .nav-2 .nav li.dropdown.open > .dropdown-toggle,
            #plazart-mainnav .nav-2 .nav li.dropdown.active > .dropdown-toggle,
            #plazart-mainnav .nav-2 .nav li.dropdown.open.active > .dropdown-toggle,
            #plazart-mainnav .nav-2 .nav > li.dropdown.open.active > a:hover{
                background-color: ' . $menu_color_bg_active . ';
            }

            #plazart-mainnav .plazart-megamenu ul.level0.navbar-nav > li.dropdown.active > a,
            #plazart-mainnav .plazart-megamenu ul.level0.navbar-nav > li.open.dropdown.active > a,
            #plazart-mainnav .plazart-megamenu ul.level0.navbar-nav > li.dropdown.active > a > i{
                background-color: ' . $menu_color_bg_active . ' !important;
            }
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li.active{
                background-color: ' . $menu_color_bg_active . ' !important;
            }
        ';
    }
    if ($menu_color_bg) {
        $css_custom .= '
            #plazart-mainnav .mega-menu.top-nav ul.level0 > li.active:after,
            #plazart-mainnav .mega-menu.top-nav ul.level0 > li:hover:after,
            #plazart-mainnav .nav-2.top-nav ul.level0 > li.active:after,
            #plazart-mainnav .nav-2.top-nav ul.level0 > li:hover:after{
                background-color: ' . $menu_color_bg . ';
            }
        ';
    }
    if ($submenu_color_bg) {
        $css_custom .= '
            .head-style3 #plazart-mainnav .dropdown-menu li > a,
            #plazart-mainnav .mega-menu.top-nav li li > a,
            #plazart-mainnav .nav-2.top-nav li li > a,
            #plazart-mainnav .dropdown-menu li > a{
                background-color: ' . $submenu_color_bg . ';
            }

            #plazart-mainnav ul.level0 .new_sub .nav-child{
                background-color: ' . $submenu_color_bg . '!important;
            }
            #off-canvas-nav .plazart-mainnav ul li li{
                background-color: ' . $submenu_color_bg . ';
            }
        ';
    }
    if ($submenu_color_bg_hover) {
        $css_custom .= '
            #plazart-mainnav .dropdown-menu li > a:hover,
            #plazart-mainnav .dropdown-menu li > a:focus,
            #plazart-mainnav .dropdown-submenu:hover > a,
            #plazart-mainnav .dropdown-submenu.open > a,
            #plazart-mainnav .mega-menu.top-nav li li:hover > a,
            #plazart-mainnav .nav-2.top-nav li li:hover > a{
                background-color: ' . $submenu_color_bg_hover . ';
            }

            .head-style3 #plazart-mainnav .dropdown-menu li.open > a,
            .head-style3 #plazart-mainnav .dropdown-menu li > a:hover{
                background-color: ' . $submenu_color_bg_hover . ';
            }
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li ul > li.open:hover > a,
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li ul > li > a:hover{
                background-color: ' . $submenu_color_bg_hover . '!important;
            }
        ';
    }
    if ($submenu_color_bg_active) {
        $css_custom .= '
            #plazart-mainnav .mega-menu.top-nav li li.active > a,
            #plazart-mainnav .nav-2.top-nav li li.active > a,
            #plazart-mainnav .nav-2.top-nav li li.active:hover > a,
            #plazart-mainnav .nav-2.top-nav li li.active.open > a,
            #plazart-mainnav .dropdown-menu .active > a,
            #plazart-mainnav .dropdown-menu .active > a:hover
            {
                background-color: ' . $submenu_color_bg_active . ';
            }

            .head-style3 #plazart-mainnav .dropdown-menu li.active > a{
                background-color: ' . $submenu_color_bg_active . ' !important;
            }
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li ul > li.current.active a{
                background-color: ' . $submenu_color_bg_active . ' !important;
            }
        ';
    }
    if ($submenu_color_text) {
        $css_custom .= '
            .head-style3 #plazart-mainnav .dropdown-menu li > a,
            .head-style3 #plazart-mainnav .dropdown-menu li.dropdown-submenu:after,
            #plazart-mainnav .dropdown-menu li > a,
            .top-nav li li.dropdown-submenu:after
            {
                color: ' . $submenu_color_text . ';
            }
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li ul > li a{
                color: ' . $submenu_color_text . ';
            }
        ';
    }
    if ($submenu_color_text_active) {
        $css_custom .= '
            #plazart-mainnav .mega-menu.top-nav li li.active:hover > a,
            #plazart-mainnav .nav-2.top-nav li li.active:hover > a,
            #plazart-mainnav .mega-menu.top-nav li li.active > a,
            #plazart-mainnav .nav-2.top-nav li li.active > a,
            .top-nav li li.dropdown-submenu.active:after,
            #plazart-mainnav .top-nav li li.dropdown-submenu.active > a
             #plazart-mainnav .dropdown-menu .active > a,
             #plazart-mainnav .dropdown-menu .active > a:hover{
                color: ' . $submenu_color_text_active . ' !important;
            }

            #plazart-mainnav ul.level0 li li.active.dropdown-submenu:hover:after,
            #plazart-mainnav ul.level0 li li.active.open > a,
            #plazart-mainnav ul.level0 li li.active > a{
                color: ' . $submenu_color_text_active . ' !important;
            }

            .head-style3 #plazart-mainnav .dropdown-menu li.active > a:hover{
            color: ' . $submenu_color_text_active . ' !important;
            }
            .head-style3 #plazart-mainnav .dropdown-menu li.active.dropdown-submenu:after{
            color: ' . $submenu_color_text_active . ';
            }
            #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li ul > li.current.active a{
                color: ' . $submenu_color_text_active . ';
            }
        ';
    }
    if ($submenu_color_text_hover) {
        $css_custom .= '
            #plazart-mainnav ul.level0 li li.open > a,
            #plazart-mainnav ul.level0 li li > a:hover,
            #plazart-mainnav .mega-menu.top-nav li li:hover > a,
             #plazart-mainnav .nav-2.top-nav li li:hover > a,
            .top-nav li li.dropdown-submenu:hover:after,
            .top-nav li li.dropdown-submenu:hover > a{
                color: ' . $submenu_color_text_hover . ' !important;
            }

            .head-style3 #plazart-mainnav .dropdown-menu li > a:hover{
                color: ' . $submenu_color_text_hover . ' !important;
            }
             #off-canvas-nav .plazart-mainnav .top-nav ul.level0 > li ul > li a:hover{
                color: ' . $submenu_color_text_hover . ' !important;
            }
        ';
    }
}
if (trim($css_custom)) {
    if (!$this->addExtraCSS($css_custom, 'custom')) $this->addStyleDeclaration($css_custom);
}
?>
