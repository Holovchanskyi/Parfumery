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
$style = '.block-bg-4{
     background: url(' . JUri::root() . $params->get('background_parallax') . ') no-repeat fixed 0 0 / cover  rgba(0, 0, 0, 0);
}';
$doc->addStyleDeclaration($style);
?>
<?php if ($list): ?>
    <div class="fun-staff staff-2 block-bg-4 sectionWrapper black-overlay">
        <?php if ($params->get('fullwidth') == 1): ?>
        <div class="center" style="color: white;"><p style="font-size:25px;">Покупай духи у нас и качество гарантировано!</p>
            </div>
        <div class="container">
            <?php endif; ?>
            <?php foreach ($list as $i => $item): ?>
                <?php if ($item->style == '1') {
                    $width = 'cell-2';
                } else {
                    $width = 'cell-4';
                }?>
            
                <div class="<?php echo $width ?> fx" data-animate="fadeInDown"
                     data-animation-delay="<?php echo $item->delay_animation; ?>">

                    <?php if ($item->style == '1'): ?>
                        <div class="fun-icon"><i class="<?php echo $item->icon; ?> witTxt"></i></div>
                    <div class="center" style="color: white; margin-top:15px;"><p style="font-size:25px;">Более</p>
            </div>
                        <div class="fun-number witTxt"><?php echo $item->value ?></div>                                            <div class="fun-text witTxt"><?php echo $item->title ?></div>

                    <?php else: ?>
                        <div class="fun-title extraBold">
                            <?php echo $item->desc; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <?php if ($params->get('fullwidth') == 1): ?>
        </div>
    <?php endif; ?>
    </div>

<?php endif; ?>
