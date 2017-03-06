<?php

/*------------------------------------------------------------------------
# ------------------------------------------------------------------------

# author    TuanNATemplaza

# copyright Copyright (C) 2013 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/
// no direct access

defined('_JEXEC') or die;
?>
<?php $style = $params->get('style_layout3', 1); ?>
<?php if ($style == 1): ?>
    <div class="oe-white oe-reflect-bg oe-home-product-blackbg over"
         data-uk-scrollspy="{cls:'animate-started',delay:500}">
        <div class="container oe-effects oe-frombottom">
            <div class="row oe-mbot oe-mtop">
                <?php if ($params->get('image3')): ?>
                    <div class="col-md-5 text-right hidden-sm hidden-xs">
                        <img src="<?php echo $params->get('image3'); ?>" alt="">
                    </div>
                <?php endif; ?>
                <?php if ($list): ?>
                <div class="col-sm-12 col-xs-12 col-md-7">
                    <div class="oe-group-progress" data-uk-scrollspy="{cls:'oe-progress-active', repeat: true}">
                        <?php foreach ($list as $item): ?>
                            <span class="oe-progress-title oe-text-reflect"><?php echo $item->title ?></span>
                            <div class="progress oe-progress oe-progress-2">
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $item->value ?>"
                                     aria-valuemin="0"
                                     aria-valuemax="100" style="width: <?php echo $item->value ?>%;">
                                    <span class="sr-only"><?php echo $item->value ?>% Complete</span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <div class="row oe-row oe-row-fullwidth">
        <?php if ($params->get('image3')): ?>
            <div class="col-md-5 oe-col-non-pd hidden-sm hidden-xs">
                <figure class="oe-image-item">
                    <img src="<?php echo $params->get('image3'); ?>" alt="">
                </figure>
            </div>
        <?php endif; ?>
        <?php if ($list): ?>
            <div class="col-md-7">
                <?php foreach ($list as $i => $item): ?>
                    <div class="oe-group-progress oe-mtop" data-uk-scrollspy="{cls:'oe-progress-active', repeat: true}">
                        <span class="oe-progress-title oe-text-reflect"><?php echo $item->title ?></span>

                        <div class="progress oe-progress oe-progress-1">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $item->value ?>"
                                 aria-valuemin="0"
                                 aria-valuemax="100" style="width: <?php echo $item->value ?>%;">
                                <span class="sr-only"><?php echo $item->value ?>% Complete</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>