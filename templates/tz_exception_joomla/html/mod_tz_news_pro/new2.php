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
    <?php if (isset($list) && !empty($list)) :
        foreach ($list as $item) :
            $media = $item->media; ?>
            <?php if ($item->type_media != 'quote' AND $item->type_media != 'link' AND $item->type_media != 'audio'): ?>
            <div class="cell-4 post fx" data-animate="fadeInLeft">
                <?php if ($image == 1 AND $item->image != null) : ?>
                    <div class="post-image">
                        <a href="<?php echo $item->link; ?>" title="<?php echo $item->title; ?>">
                            <div class="mask"></div>
                            <div class="post-lft-info">
                                <div class="main-bg">
                                    <?php echo JHtml::_('date', $list[0]->created, 'd'); ?>
                                    <br>
                                    <?php echo JHtml::_('date', $list[0]->created, 'M'); ?>
                                    <br>
                                    <?php echo JHtml::_('date', $list[0]->created, 'Y'); ?></div>
                            </div>
                            <?php $title_image = $item->title; ?>
                            <img src="<?php echo $item->image; ?>"
                                 title="<?php echo $title_image; ?>"
                                 alt="<?php echo $title_image; ?>"/>
                        </a>
                    </div>
                <?php endif; ?>
                <article class="post-content">
                    <?php if ($title == 1 or $date == 1 or $hits == 1 or $author_new == 1 or $cats_new == 1) : ?>

                        <?php if ($title == 1): ?>
                            <div class="post-info-container">
                                <div class="post-info">
                                    <h2>
                                        <a href="<?php echo $item->link; ?>" title="<?php echo $item->title; ?>"
                                           class="main-color">
                                            <?php echo $item->title; ?>
                                        </a>
                                    </h2>
                                </div>
                            </div>
                        <?php endif; ?>
                        <ul class="post-meta">
                            <li class="meta-user">
                                <?php if ($author_new == 1): ?>
                                    <?php echo JText::sprintf('MOD_TZ_NEWS_AUTHOR_1', '<a>' . $item->author . '</a>'); ?>
                                <?php endif; ?>
                            </li>
                            <li>
                                <?php if ($cats_new == 1): ?>
                                    <?php echo JText::sprintf('MOD_TZ_NEWS_CATEGORY_1', '<a>' . $item->category . '</a>'); ?>
                                <?php endif; ?>
                            </li>
                            <li>
                                <?php if ($date == 1) : ?>
                                    <?php echo JText::sprintf('MOD_TZ_NEWS_DATE_ALL', JHtml::_('date', $item->created, JText::_('MOD_TZ_NEWS_DATE_FOMAT'))); ?>
                                <?php endif; ?>
                            </li>
                            <li>
                                <?php if ($hits == 1) : ?>
                                    <?php echo JText::sprintf('MOD_TZ_NEWS_HIST_LIST', $item->hit) ?>
                                <?php endif; ?>
                            </li>
                        </ul>
                        <?php if ($des == 1) : ?>
                            <p>
                                <?php if ($limittext) :
                                    echo substr($item->intro, 3, $limittext);
                                else :
                                    echo $item->intro;
                                endif;?>
                            </p>
                        <?php endif; ?>
                        <?php if ($readmore == 1) : ?>
                            <a href="<?php echo $item->link; ?>" class="read-more">
                                <?php echo JText::_('MOD_TZ_NEWS_READ_MORE') ?>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </article>

                <div class="clearfix"></div>
            </div>
        <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<div class="clearfix"></div>

