<?php
/*------------------------------------------------------------------------
    # (TZ Module, TZ Plugin, TZ Component)
    # ------------------------------------------------------------------------
    # author    Sunland .,JSC
    # copyright Copyright (C) 2011 Sunland .,JSC. All Rights Reserved.
    # @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
    # Websites: http://www.TemPlaza.com
    # Technical Support:  Forum - http://www.TemPlaza.com/forums/
-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die('Restricted access');

$url = JURI::base();

$tz_effect = $params->get('tz_effect', 'fade');
$tz_autoslide = $params->get('tz_autoslide');
$tz_speed = $params->get('tz_slideSpeed', '7000');
$tz_anispeed = $params->get('tz_speed', '1000');
$tz_direction = $params->get('tz_direction_slide');
$flex_width = $params->get('flex_width', '100');
$flex_height = $params->get('flex_height');
$thumb_height = $params->get('thumb_height');
$flex_thumb = $params->get('flex_thumb', 'true');
$flex_width_thumb = $params->get('flex_width_thumb', '300');
$flex_bottom_thumb = $params->get('flex_bottom_thumb', '-85');
$flex_loop = $params->get('flex_loop', 'true');
$units_width_Flex = $params->get('units_width_Flex');
$units_height_Flex = $params->get('units_height_Flex');
$units_height_Flex_thumb = $params->get('units_height_Flex');
$document = JFactory::getDocument();
$document->addStyleSheet('modules/mod_tz_multi_slideshow/css/flexslider.css');

$document->addStyleDeclaration('
    #tz_Flexslider{
    overflow:hidden;
    position:relative;
    }
    #carousel{
    bottom:' . $flex_bottom_thumb . 'px !important;
    }
    #tz_Flexslider{
        width:' . $flex_width . '' . $units_width_Flex . ';
    }
    #tz_Flexslider #slider .flexslider .slides > li{
        height: ' . $flex_height . '' . $units_height_Flex . ';
    }
    #tz_Flexslider #carousel ul li img{
    height: ' . $thumb_height . '' . $units_height_Flex_thumb . ';
    }
');

?>

<script type="text/javascript" src="<?php echo $url; ?>modules/mod_tz_multi_slideshow/js/jquery.flexslider.js"></script>

<div class="tz_slideshow">
    <div id="tz_Flexslider">
        <div id="slider" class="flexslider">
            <ul class="slides">
                <?php foreach ($list as $i => $item): ?>
                    <?php if (($i+1) % 2 == 0) $prefix_1 = 'rit'; else $prefix_1 = ''; ?>
                    <li>
                        <div class="info_slide">

                            <img src="<?php echo JUri::root() . $item->image; ?>"
                                 alt="<?php echo $item->title; ?>"/>
                            <?php if ($title == 1 || $intro == 1) { ?>
                            <div class="absolute-slide <?php echo $prefix_1; ?>">
                                <?php } ?>
                                <?php if ($title == 1) { ?>
                                    <span class="flex-caption ">
                                        <a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
                                    </span>
                                <?php } ?>
                                <?php if ($intro == 1) { ?>
                                    <span class="flex-caption">
                                        <?php
                                        if (isset($limittext) && !empty($limittext)) {
                                            $arr_title = explode(' ', $item->intro);
                                            $arr_title = array_slice($arr_title, 0, $limittext);
                                            $arr_text = implode(' ', $arr_title);
                                            echo $arr_text;
                                        } else {
                                            echo $item->intro;
                                        }
                                        ?>
                                    </span>
                                <?php } ?>
                                <?php if ($title == 1 || $intro == 1) { ?>
                            </div>

                        <?php } ?>
                        </div>
                    </li>
                <?php endforeach; ?>

            </ul>

        </div>
        <?php if ($flex_thumb == 'true') { ?>

            <div id="carousel" class="flexslider">
                <ul class="slides">
                    <?php foreach ($list as $item): ?>
                        <li>
                            <img src="<?php echo $item->image; ?>"/>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php } ?>
    </div>
</div>
<?php if ($flex_thumb == 'true') { ?>
    <script type="text/javascript">
        jQuery(window).load(function () {
            jQuery('#carousel').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: true,
                itemWidth: <?php echo $flex_width_thumb;?>,
                itemMargin: 0,
                slideshowSpeed: <?php echo $tz_speed; ?>,
                animationSpeed: 1500,
                asNavFor: '#slider'
            });

            jQuery('#slider').flexslider({
                animation: "<?php echo $tz_effect; ?>",
                slideshowSpeed: <?php echo $tz_speed; ?>,
                animationSpeed: <?php echo $tz_anispeed; ?>,
                controlNav: <?php echo $tz_direction; ?>,
                animationLoop: <?php echo $flex_loop; ?>,
                slideshow: <?php echo $tz_autoslide; ?>,
                sync: "#carousel",
                start: function (slider) {
                    jQuery('body').removeClass('loading');
                }
            });
        });
    </script>
<?php } else { ?>
    <script type="text/javascript">
        jQuery(window).load(function () {
            jQuery('#slider').flexslider({
                animation: "<?php echo $tz_effect; ?>",
                controlNav: <?php echo $tz_direction; ?>,
                animationLoop: <?php echo $flex_loop; ?>,
                slideshow: <?php echo $tz_autoslide; ?>,
                start: function (slider) {
                    jQuery('body').removeClass('loading');
                }
            });
        });
    </script>
<?php } ?>



