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
    <div class="row">
        <?php foreach ($list as $item): ?>
            <div class="cell-4 service-box-4 fx" data-animate="fadeInUp"
                 data-animation-delay="<?php echo $item->delay_animation; ?>">
                <div class="cell-3">
                    <a href="<?php echo $item->link ?>">
                        <i class="icon main-bg <?php echo $item->icon; ?>"></i>
                    </a>
                </div>
                <div class="cell-9">
                    <h3><?php echo $item->title ?></h3>

                    <p>
                        <?php echo $item->content; ?>
                    </p>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
<?php endif; ?>
