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
<?php if ($list): ?>
    <div class="padd-top-80">
        <?php $delay = 0; ?>
        <?php foreach ($list as $i => $item): ?>
            <?php if ($item->active): ?>
                <?php $class = "selected";
                $class1 = 'highInd';
                $color = 'main-color';
                $color1 = 'main-bg';
                $color2 = 'main-color'?>

            <?php else: ?>
                <?php $class = '';
                $class1 = '';
                $color = 'alter-color';
                $color1 = 'alter-bg';
                $color2 = '';?>

            <?php endif; ?>

            <div class="fx  cell-3 <?php echo $class1; ?>" data-animate="flipInY"
                 data-animation-delay="<?php echo $delay ?>">
                <div class="pricing-table <?php echo $class; ?>">

                    <i class="<?php echo $item->icon; ?> <?php echo $color1; ?>"></i>
                    <ul>

                        <li class="head">
                            <?php echo $item->title; ?>
                        </li>
                        <li class="price">
                            <span class="<?php echo $color?>"><?php echo $item->price; ?></span> /month
                        </li>
                        <?php $arr = explode(",", $item->content); ?>
                        <?php foreach ($arr as $i => $m): ?>

                            <li><?php echo $m; ?></li>
                        <?php endforeach; ?>
                        <li class="pricing-footer">
                            <?php if ($item->button_link): ?>
                            <a href="<?php echo $item->button_link; ?>" class="btn btn-medium <?php echo $color1; ?>">
                                <?php endif; ?>
                                <span><?php echo $item->button_text; ?></span>
                                <?php if ($item->button_link): ?>
                            </a>
                        <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
            <?php $delay += 200; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
