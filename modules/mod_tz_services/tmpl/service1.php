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
$doc = JFactory::getDocument();
if ($params->get('bg')) {
    $bg = '.bg1{
       background: url("' . JUri::root() . $params->get('bg') . '") repeat scroll 0 0 ' . $params->get('bg_color') . ';
    }';

} else {
    $bg = '.bg1{
       background-color: ' . $params->get('bg_color') . ';
    }';
}
$doc->addStyleDeclaration($bg);
?>
<?php if ($list): ?>
    <div class="row no-padding">
        <?php foreach ($list as $i => $item): ?>
            <div class="cell-3 service-box-1 fx" data-animate="fadeInUp"
                 data-animation-delay="<?php echo $item->delay_animation; ?>">
                <div class="box-top">
                    <i class="<?php echo $item->icon; ?>"></i>

                    <h3><?php echo $item->title; ?></h3>
                    <?php echo $item->content; ?>
                    <a class="more-btn" href="<?php echo $item->link ?>">
                        Подробнее
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>