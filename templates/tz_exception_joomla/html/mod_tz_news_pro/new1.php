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

<div class="news-site">
    <?php if ($params->get('show_button_all') == 1): ?>
        <h3 class="block-head-News">
            <span class="icon fa fa-angle-right"></span>
            <?php echo $module->title; ?>

            <a href="<?php echo $params->get('link_recent'); ?>"><?php echo $params->get('text_recent'); ?>
                <span class="fa fa-plus"></span></a>
        </h3>
    <?php endif; ?>
    <div class="blog-posts">
        <?php if (isset($list) && !empty($list)) : ?>
            <?php if ($list[0]->type_media != 'quote' AND $list[0]->type_media != 'link' AND $list[0]->type_media != 'audio'): ?>
                <div class="post-item fx row" data-animate="fadeInLeft">
                    <div class="cell-6 cell-new-1">
                        <div class="post-image ">
                            <a href="<?php echo $list[0]->link ?>">
                                <div class="mask"></div>
                                <div class="post-lft-info">
                                    <div class="main-bg">
                                        <?php echo JHtml::_('date', $list[0]->created, 'd'); ?>
                                        <br>
                                        <?php echo JHtml::_('date', $list[0]->created, 'M'); ?>
                                        <br>
                                        <?php echo JHtml::_('date', $list[0]->created, 'Y'); ?>
                                    </div>
                                </div>
                                <img src="<?php echo $list[0]->image; ?>" alt="<?php $list[0]->title; ?>">
                            </a>
                        </div>
                    </div>
                    <div class="cell-6 cell-new-2">
                        <article class="post-content">
                            <div class="post-info-container">
                                <div class="post-info">
                                    <h2><a class="main-color" href="<?php echo $list[0]->link; ?>">
                                            <?php echo $list[0]->title; ?></a></h2>
                                    <ul class="post-meta">
                                        <li class="meta-user">
                                            <?php echo JText::sprintf('TPL_EXEC_WRITTEN_BY_BLOG_ARTICLE', '<a>' . $list[0]->author . '</a>'); ?>
                                        </li>
                                        <li><?php echo JText::sprintf('TPL_EXEC_CATEGORY_BLOG_ARTICLE', '<a>' . $list[0]->category . '</a>');?>
                                        </li>
                                        <li class="meta-comments">
                                            <?php echo JText::sprintf('TPL_EXEC_ARTICLE_HITS', $list[0]->hit);?></li>
                                    </ul>
                                </div>
                            </div>
                            <p>
                                <?php if ($limittext) :
                                    echo substr($list[0]->intro, 3, $limittext);
                                else :
                                    echo $list[0]->intro;
                                endif;?>
                                <?php if ($readmore == 1) : ?>
                                    <a href="<?php echo $list[0]->link; ?>" class="read-more">
                                        <?php echo JText::_('MOD_TZ_NEWS_READ_MORE') ?>
                                    </a>
                                <?php endif; ?>
                            </p>
                        </article>
                    </div>
                </div>
            <?php endif; ?>
            <div class="clearfix"></div>
            <?php foreach ($list as $i => $item) : ?>
                <?php if ($i > 0) { ?>
                    <?php $media = $item->media; ?>
                    <?php if ($item->type_media != 'quote' AND $item->type_media != 'link' AND $item->type_media != 'audio'): ?>
                        <?php if ($i == 1 || $i % 2 != 0) { ?>
                            <div class="small_items">
                            <div class="row">
                        <?php } ?>
                        <div class="cell-6">
                            <div class="post-item fx" data-animate="fadeInLeft">
                                <?php if ($image == 1 AND $item->image != null) : ?>
                                    <div class="cell-3">
                                        <div class="row">
                                            <a href="<?php echo $item->link; ?>"
                                               title="<?php echo $item->title; ?>">
                                                <?php $title_image = $item->title; ?>
                                                <img src="<?php echo $item->image; ?>"
                                                     title="<?php echo $title_image; ?>"
                                                     alt="<?php echo $title_image; ?>"/>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <article class="cell-9">
                                    <?php if ($title == 1 or $date == 1 or $hits == 1 or $author_new == 1 or $cats_new == 1) : ?>
                                        <?php if ($title == 1): ?>
                                            <h2>
                                                <a href="<?php echo $item->link; ?>"
                                                   title="<?php echo $item->title; ?>"
                                                   class="main-color">
                                                    <?php echo $item->title; ?>
                                                </a>
                                            </h2>
                                        <?php endif; ?>
                                        <ul class="post-meta">
                                            <li class="meta-user">
                                                <?php if ($author_new == 1):
                                                    echo JText::sprintf('TPL_EXEC_WRITTEN_BY_BLOG_ARTICLE', '<a>' . $item->author . '</a>');
                                                endif; ?>
                                            </li>
                                            <li>
                                                <?php if ($cats_new == 1):
                                                    echo JText::sprintf('TPL_EXEC_CATEGORY_BLOG_ARTICLE', '<a>' . $item->category . '</a>');
                                                endif; ?>
                                            </li>
                                            <li>
                                                <?php if ($hits == 1) :
                                                    echo JText::sprintf('TPL_EXEC_ARTICLE_HITS', $item->hit);
                                                endif; ?>
                                            </li>
                                        </ul>
                                        <?php if ($date == 1) : ?>
                                            <span class="project-options">
                                                            <?php echo JText::sprintf('MOD_TZ_NEWS_DATE_ALL', JHtml::_('date', $item->created, JText::_('MOD_TZ_NEWS_DATE_FOMAT'))); ?>
                                                        </span>
                                        <?php endif; ?>

                                    <?php endif; ?>
                                </article>
                            </div>
                        </div>
                        <?php if ($i % 2 == 0) { ?>
                            </div>
                            </div>
                            <div class="clearfix"></div>
                        <?php } ?>
                    <?php endif; ?>
                <?php } ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
