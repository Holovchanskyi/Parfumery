<?php
/*------------------------------------------------------------------------

# ------------------------------------------------------------------------

# author    TuanNATemplaza

# copyright Copyright (C) 2012-2013 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

//no direct access
defined('_JEXEC') or die();
$doc = JFactory::getDocument();?>
<?php if ($list) : ?>
    <?php foreach ($list as $item): ?>
        <div class="cell-3 service-box-3 fx" data-animate="fadeInDown">
            <div class="box-head">
                <i class="icon main-bg <?php echo $item->icon; ?>"></i>
                <h4 class="main-color"><span
                        data-hover="<?php echo $item->title ?>"><?php echo $item->title ?></span>
                </h4>
            </div>
            <div class="oe-callout-content">

                    <?php echo $item->content; ?>


            </div>
            <a class="r-more main-color" href="<?php echo $item->link ?>">
                <?php echo JText::_('READ_MORE_SERVICE_3') ?>
            </a>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
