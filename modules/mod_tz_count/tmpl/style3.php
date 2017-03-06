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
if ($params->get('background_parallax')):
    $style = '.block-bg-3{
     background: url(' . JUri::root() . $params->get('background_parallax') . ') no-repeat fixed 0 0 / cover  rgba(0, 0, 0, 0);
    }';
    $doc->addStyleDeclaration($style);
endif;
if ($params->get('column_style3') == 1) {
    $class = 'cell-3';
} else {
    $class = 'cell-6';
}
?>
<?php if ($list): ?>
    <?php if ($params->get('column_style3') == 2): ?>
        <div class="porto-stats">
    <?php endif; ?>
    <div class="staff-3">
        <?php if ($params->get('fullwidth') == 1): ?>
        <div class="container">
            <?php endif; ?>
            <?php foreach ($list as $i => $item): ?>
                <?php if ($item->style == '1') { ?>
                    <div class="<?php echo $class; ?> fx" data-animate="bounceIn"
                         data-animation-delay="<?php echo $item->delay_animation; ?>">
                        <div class="<?php echo $params->get('class_custom'); ?>">
                            <div class="fun-number"><?php echo $item->value ?></div>
                            <div class="fun-text"><?php echo $item->title ?></div>
                        </div>
                    </div>
                <?php } ?>
            <?php endforeach; ?>
            <?php if ($params->get('fullwidth') == 1): ?>
        </div>
    <?php endif; ?>
    </div>
    <?php if ($params->get('column_style3') == 2): ?>
        </div>
    <?php endif; ?>


<?php endif; ?>
