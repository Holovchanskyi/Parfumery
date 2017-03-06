<?php

/*------------------------------------------------------------------------

# MOD_TZ_NEW_PRO Extension

# ------------------------------------------------------------------------

# author    tuyennv

# copyright Copyright (C) 2013 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die;
$document = JFactory::getDocument();
$document->addScript(JUri::base() . 'modules/mod_tz_news_pro/js/slick.min.js');
?>

<?php if ($params->get('show_button_all') == 1): ?>
    <h3 class="block-head-News">
        <span class="icon fa fa-angle-right"></span>
        <?php echo $module->title; ?>
        <a href="<?php echo $params->get('link_recent'); ?>">
            <?php echo $params->get('text_recent'); ?>
            <span class="fa fa-plus"></span>
        </a>
    </h3>
<?php endif; ?>

<div class="news-masnory">
    <?php if (isset($list) && !empty($list)) : ?>
    <ul class="gallery">
        <?php foreach ($list as $item) :
            $media = $item->media; ?>
            <?php if ($item->type_media != 'quote' AND $item->type_media != 'link' AND $item->type_media != 'audio'): ?>
            <?php if ($item->image != null) : ?>
                <li>
                    <a href="<?php echo $item->image; ?>" title="<?php echo $item->title; ?>" class="zoom"
                       data-gal="prettyPhoto[pp_gal]">
                        <?php $title_image = $item->title; ?>
                        <img src="<?php echo $item->image; ?>"
                             title="<?php echo $title_image; ?>"
                             alt="<?php echo $title_image; ?>"/>
                        <span class="img-overlay"></span>
                    </a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
        <?php endforeach; ?>

        <?php endif; ?>
    </ul>
</div>


