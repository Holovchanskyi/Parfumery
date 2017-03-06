<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$params_template = JFactory::getApplication()->getTemplate(true)->params;
$class_menu = '';
$doc = JFactory::getDocument();

if ($params_template->get('type_menu') == 1) {
    $class_menu = ' mega-menu';
}
if ($params_template->get('type_menu') == 2 or $params_template->get('type_menu') == 3) {
    $border = 'header.top-head{
    border: 0  none ;
    }';
    $doc->addStyleDeclaration($border);
    if ($params_template->get('type_menu') == 2) {
        $class_menu = ' nav-2';
    }
    if ($params_template->get('type_menu') == 3) {
        $class_menu = ' nav-3';
    }
}
if ($params_template->get('type_menu') == 4) {
    $class_menu = ' mega-menu';
}
if ($params_template->get('type_fix') == 0) {
    $data = 'data-sticky="true"';
} else {
    $data = '';
}

?>
<!-- MAIN NAVIGATION -->
<nav id="plazart-mainnav" class="wrap plazart-mainnav  navbar navbar-default">
    <div class="navbar-inner">
        <div class="navbar-header">
            <button type="button" class=" btn-navbar menuBtn navbar-toggle" data-toggle="collapse"
                    data-target=".nav-collapse">
                <i class="fa fa-bars"></i>
            </button>
        </div>

        <div class="    top-nav nav-collapse navbar-collapse no-padding
                        collapse<?php echo $this->getParam('navigation_collapse_showsub', 1) ? ' always-show' : '' ?>
                        <?php echo $class_menu; ?> " <?php echo $data; ?> >
            <h3 class="title_menu"><?php echo JText::_('TITLE_CANVAS_MENU'); ?></h3>
            <?php if ($this->getParam('navigation_type') == 'megamenu') : ?>
                <?php ob_start(); ?>
                <?php $this->megamenu($this->getParam('mm_type', 'mainmenu')) ?>
                <?php
                $content = ob_get_contents();
                ob_end_clean();

                if (preg_match('/(<a.*?href=".*?#)(.*?<\/a>)/msi', $content)) {
                    $content = preg_replace('/(<a.*?href=".*?#)(.*?<\/a>)/msi', '$1tz-$2', $content);
                }
                echo $content;

                ?>
            <?php else : ?>
                <jdoc:include type="modules" name="menu" style="raw"/>
            <?php endif ?>

        </div>
        <div class="top-search">
            <jdoc:include type="modules" name="search-top-label" style="raw"/>
        </div>
    </div>

</nav>

<?php if ($params_template->get('scroll_custom') == 1):
    $doc->addStyleDeclaration('
        html{overflow:hidden;}
    ');
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('body').niceScroll({
                cursorborderradius: '0px', // Scroll cursor radius
                background: '#E5E9E7',     // The scrollbar rail color
                cursorwidth: '10px',       // Scroll cursor width
                cursorcolor: '#999999'     // Scroll cursor color
            });
        });
    </script>
<?php endif; ?>
<?php if ($params_template->get('one_page') == 1): ?>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery(".scroll").click(function (e) {
                e.preventDefault();
                jQuery("html, body").animate({scrollTop: jQuery(jQuery(this).attr("href")).offset().top - 200 + "px"}, {duration: 800});
                return false;
            });

            if (jQuery('#plazart-mainnav').length) {
                jQuery('#plazart-mainnav').onePageNav();
            }
        });
    </script>
<?php endif; ?>
<?php if ($params_template->get('type_fix') != 'no' && $params_template->get('type_fix') != 1): ?>
    <script type="text/javascript">
        jQuery(document).ready(function () {

            if (jQuery('.top-nav').attr('data-sticky') == "true") {
                jQuery(window).on("scroll", function () {
                    var Scrl = jQuery(window).scrollTop();
                    if (Scrl > 1) {
                        jQuery('.top-head').addClass('sticky');
                    } else {
                        jQuery('.top-head').removeClass('sticky');
                    }
                });
                jQuery('document').ready(function () {
                    var Scrl = jQuery(window).scrollTop();
                    if (Scrl > 1) {
                        jQuery('.top-head').addClass('sticky');
                    } else {
                        jQuery('.top-head').removeClass('sticky');
                    }
                });
            }
        });

    </script>
<?php endif; ?>

<?php if ($params_template->get('type_fix') == 1): ?>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            var tp = jQuery('.top-head').offset();
            jQuery(window).scroll(function () {
                var scrollHeight = jQuery(document).scrollTop();
                if (jQuery(this).scrollTop() > tp.top) {
                    jQuery('.top-head').addClass('sticky');
                    jQuery('.top-head').addClass('sticky_home4');
                } else {
                    jQuery('.top-head ').removeClass('sticky');
                    jQuery('.top-head').removeClass('sticky_home4');
                }
            });
        });
    </script>
<?php endif; ?>

<script type="text/javascript">
    <?php if($params_template->get('rtl')== 0):?>
    jQuery(document).ready(function () {
        jQuery(window).on('load ', function () {
            if (jQuery(window).width() <= 768) {
                if (jQuery('.top-head').prev().css('display') != 'none') {
                    var height1 = jQuery('.top-head').prev().height();
                } else {
                    var height1 = 0;
                }
                var height = jQuery('.top-head ').height() + height1 - jQuery('#plazart-mainnav').height() + 2;
                jQuery('#plazart-mainnav').css({
                    position: "absolute",
                    top: -height,
                    margin: "0",
                    width: "auto"

                });
            } else {
                jQuery('#plazart-mainnav').css({
                    position: "relative",
                    top: 0,
                    width: "100%"
                });
            }
        });
        jQuery(window).on('resize', function () {
            if (jQuery(window).width() < 768) {
                var height2 = 0;
            } else {
                var height2 = jQuery('#plazart-mainnav').height();
            }
            if (jQuery(window).width() <= 768) {

                if (jQuery('.top-head').prev().css('display') != 'none') {
                    var height1 = jQuery('.top-head').prev().height();
                } else {
                    var height1 = 0;
                }
                var height = jQuery('.top-head ').height() + height1 + 2 - height2;
                jQuery('#plazart-mainnav').css({
                    position: "absolute",
                    top: -height,
                    margin: "0",
                    width: "auto"
                });
            } else {
                jQuery('#plazart-mainnav').css({
                    position: "relative",
                    top: 0,
                    width: "100%"
                });
            }
        });
    });
    <?php else:?>
    jQuery(document).ready(function () {
        if (jQuery(window).width() <= 768) {

            if (jQuery('.top-head').prev().css('display') != 'none') {
                var height1 = jQuery('.top-head').prev().height();
            } else {
                var height1 = 0;
            }
            var height = jQuery('#tz-logo ').height() + height1 - jQuery('#plazart-mainnav').height() + 2;
            jQuery('#plazart-mainnav').css({
                position: "absolute",
                top: -height,
                margin: "0",
                width: "auto"

            });
        } else {
            jQuery('#plazart-mainnav').css({
                position: "relative",
                top: 0,
                width: "100%"
            });
        }
        jQuery(window).resize(function () {
            if (jQuery(window).width() <= 768) {
                var height2 = jQuery('#plazart-mainnav').height();
                if (jQuery('.top-head').prev().css('display') != 'none') {
                    var height1 = jQuery('.top-head').prev().height();
                } else {
                    var height1 = 0;
                }
                var height = jQuery('#tz-logo ').height() + height1 + 2 - height2;
                jQuery('#plazart-mainnav').css({
                    position: "absolute",
                    top: -height,
                    margin: "0",
                    width: "auto"
                });
            } else {
                jQuery('#plazart-mainnav').css({
                    position: "relative",
                    top: 0,
                    width: "100%"
                });
            }
        });
    });
    <?php endif;?>
</script>

<!-- //MAIN NAVIGATION -->