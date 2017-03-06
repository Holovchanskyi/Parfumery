<?php
/*------------------------------------------------------------------------

# TZ Extension

# ------------------------------------------------------------------------

# author    TuanNATEMPLAZA

# copyright Copyright (C) 2012 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

defined('_JEXEC') or die();
$doc = JFactory::getDocument();
$doc->addScript(JUri::root() . '/modules/mod_tz_testimonial/js/slick.min.js');
if ($params->get('background_parallax')):
    $bg = '.block-bg-1{
    background: url("' . JUri::base() . $params->get('background_parallax') . '") no-repeat fixed 0 0 / cover rgba(0, 0, 0, 0);
    position: relative;
    }';
    $doc->addStyleDeclaration($bg);
endif;
if ($list): ?>
    <div class="testimonials-2 <?php echo $module->id ?>">
        <?php foreach ($list as $item): ?>
            <div>
                <?php echo $item->testimonial_quotations; ?>
                <div class="testimonials-name main-bg">
                    <strong>
                        <?php echo $item->testimonial_author ?>:
                    </strong>
                    <?php echo $item->testimonial_website ?></div>
            </div>
        <?php endforeach; ?>
    </div>
    <script type="text/javascript">
        jQuery('.testimonials-2.<?php echo $module->id?>').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            touchMove: true,
            slidesToScroll: 1
        });
    </script>
<?php endif; ?>

