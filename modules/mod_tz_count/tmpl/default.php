<?php
/*------------------------------------------------------------------------

# TZ Portfolio Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2012-2013 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

//no direct access
defined('_JEXEC') or die();
$doc = JFactory::getDocument();
$style = '.block-bg-2{
     background: url(' . JUri::root() . $params->get('background_parallax') . ') no-repeat fixed 0 0 / cover  rgba(0, 0, 0, 0);
}';
$doc->addStyleDeclaration($style);
?>
<?php if ($list): ?>

    <div class="fun-staff staff-1 block-bg-2 sectionWrapper">
        <div class="container">

            <?php foreach ($list as $i => $item): ?>
                <?php if ($item->style == '1') {
                    $width = 'cell-2';
                } else {
                    $width = 'cell-4';
                }?>
             <div class="<?php echo $width ?> fx" data-animate="fadeInDown"
                     data-animation-delay="<?php echo $item->delay_animation; ?>">
                    <?php if ($item->style == '1'): ?>
                        <div class="fun-number"><?php echo $item->value; ?></div>
                        <div class="fun-text main-bg"><?php echo $item->title ?></div>
                        <div class="fun-icon"><i class="<?php echo $item->icon ?>"></i></div>
                    <?php else: ?>
                        <div class="fun-title extraBold"><?php echo $item->desc ?></div>
                    <?php endif; ?>
                </div>
                <div class="<?php echo $width ?> fx" data-animate="fadeInDown"
                     data-animation-delay="<?php echo $item->delay_animation; ?>">
                    <?php if ($item->style == '1'): ?>
                        <div class="fun-number"><?php echo $item->value; ?></div>
                        <div class="fun-text main-bg"><?php echo $item->title ?></div>
                        <div class="fun-icon"><i class="<?php echo $item->icon ?>"></i></div>
                    <?php else: ?>
                        <div class="fun-title extraBold"><?php echo $item->desc ?></div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
