<?php
/*------------------------------------------------------------------------

# TZ Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2012 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

defined('_JEXEC') or die();
$doc = JFactory::getDocument();
if ($params->get('show_js') == 1):
    $doc->addScript('./modules/mod_tz_testimonial/js/jquery.flexslider-min.js');
    $doc->addScript('./modules/mod_tz_testimonial/js/oe-flexslider.js');
endif;

if ($list):?>
    <div data-stellar-background-ratio="0.1" class="oe-full-banner oe-fixed-banner"
         data-uk-scrollspy="{cls:'animate-started',delay:500}">

        <div class="container oe-effects oe-frombottom">
            <div class="row">
                <div class="col-md-12">
                    <div class="oe-box-testimonials-3">
                        <div class="oe-slider oe-slider-non-direction-nav oe-testimonials-slider">
                            <?php if ($params->get('title_slider')): ?>
                                <h1><?php echo $params->get('title_slider'); ?></h1>
                            <?php endif; ?>
                            <ul class="slides">
                                <?php foreach ($list as $i => $item): ?>
                                    <?php if ($i == 0 or $i % 2 == 0): ?>
                                        <li>
                                        <div class="oe-flexslider-item">
                                        <div class="oe-flexslider-content">
                                    <?php endif; ?>
                                    <div
                                        class="col-md-6 col-sm-10 col-sm-offset-2 col-xs-12 oe-flexslider-content-item">
                                        <div class="col-md-3 col-sm-3 col-xs-3 oe-testimonials-ava">
                                            <figure class="oe-image-item oe-image-rounded">
                                                <img src="<?php echo $item->testimonial_image ?>" alt=""/>
                                            </figure>
                                        </div>
                                        <div class="col-md-9 col-sm-9 col-xs-9 oe-testimonials-content">
                                            <h5 class="oe-testimonials-author"><?php echo $item->testimonial_author ?></h5>

                                            <p class="oe-testimonials-source"><?php echo $item->testimonial_website ?></p>

                                            <p><?php echo $item->testimonial_quotations ?></p>
                                        </div>
                                    </div>
                                    <?php if ($i % 2 != 0 or ($i + 1 > count($list) - 1)): ?>
                                        </div>
                                        </div>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>