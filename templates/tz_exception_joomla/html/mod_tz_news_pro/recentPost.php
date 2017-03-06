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
//$document->addScript(JUri::base() . 'modules/mod_tz_news_pro/js/slick.min.js');
?>

<div class="widget r-posts-w fx" data-animate="fadeInRight">

    <div class="widget-content">
        <ul>
            <?php foreach ($list as $item): ?>
                <li>
                    <?php if ($image == 1 AND $item->image != null) : ?>
                        <div class="post-img">
                            <img src="<?php echo $item->image; ?>" alt="">
                        </div>
                    <?php endif; ?>
                    <?php if ($title == 1 or $date == 1): ?>
                        <div class="widget-post-info">
                            <?php if ($title == 1): ?>
                                <h4>
                                    <a href="<?php echo $item->link; ?>">
                                        <?php echo $item->title; ?>
                                    </a>
                                </h4>
                            <?php endif; ?>

                            <div class="meta">
                                <?php if ($date == 1): ?>
                                    <span>
                                        <i class="<?php echo JText::_('NEWS_PRO_RECENTS_POSTS_ICON_DATE') ?>"></i>
                                        <?php echo JHtml::_('date', $item->created, JText::_('EXEC_DATE_FOMAT')); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if (isset($item->commentCount)): ?>
                                    <a href="<?php echo $item->link; ?>">
                                        <i class="<?php echo JText::_('NEWS_PRO_RECENTS_POSTS_ICON_COMMENTS') ?>"></i><?php echo $item->commentCount; ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>