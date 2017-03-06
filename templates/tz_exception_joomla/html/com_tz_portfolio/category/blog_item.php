<?php
/*------------------------------------------------------------------------

# TZ Portfolio Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2012 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die;

// Create a shortcut for params.
$params = & $this->item->params;

$images = json_decode($this->item->images);
$canEdit = $this->item->params->get('access-edit');
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
//JHtml::_('behavior.tooltip');
JHtml::_('behavior.framework');
$params_tmp = JFactory::getApplication()->getTemplate(true);
$params_template = $params_tmp->params;
$blogLink = $this->item->link;

$media = $this->media;
$media->setParams($params);
$listMedia = $media->getMedia($this->item->id);
$this->assign('listMedia', $listMedia);
?>

<?php if ($this->item->state == 0) : ?>

    <div class="system-unpublished">

<?php endif; ?>



<?php if ((isset($listMedia[0]->type) AND $listMedia[0]->type != 'quote'  AND $listMedia[0]->type != 'link') OR !isset($listMedia[0]->type)): ?>

    <?php if ($params_template->get('type_blog') == 3 or $params_template->get('type_blog') == 1): ?>
        <div class="row ">
        <?php if ($params_template->get('type_blog') == 3): ?>
            <div class="cell-4">
        <?php endif; ?>
        <?php if ($params_template->get('type_blog') == 1): ?>
            <div class="cell-12 ">
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($params->get('show_image', 1) OR $params->get('show_image_gallery', 1) OR $params->get('show_video', 1) OR $params->get('show_audio', 1)): ?>
        <?php $type_m = null; ?>
        <?php if ($listMedia[0]->type == 'video' or $listMedia[0]->type == 'audio') {
            $type_m = 'post-video';
        } ?>
        <div class="post-image <?php echo $type_m; ?>  ">
            <?php if ($listMedia[0]->type != 'video' and $listMedia[0]->type != 'audio'): ?>
            <a href="<?php echo $blogLink; ?>">
                <div class="mask"></div>
                <?php endif; ?>
                <?php if ($params->get('show_create_date')) : ?>
                <div class="post-lft-info">
                    <div class="main-bg">
                        <?php echo JHtml::_('date', $this->item->created, 'd'); ?>
                        <br>
                        <?php echo JHtml::_('date', $this->item->created, 'M'); ?>
                        <br>
                        <?php echo JHtml::_('date', $this->item->created, 'Y'); ?>
                        <span class="tri-col"></span>
                    </div>
                </div>
                <?php endif; ?>
                <?php echo $this->loadTemplate('media'); ?>
                <?php if ($listMedia[0]->type != 'video' and $listMedia[0]->type != 'audio'): ?>
            </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if ($params_template->get('type_blog') == 3 or $params_template->get('type_blog') == 1): ?>
    </div>
        <?php if ($params_template->get('type_blog') == 3): ?>
            <div class="cell-8">
        <?php endif; ?>
        <?php if ($params_template->get('type_blog') == 1): ?>
            <div class="cell-12 ">
        <?php endif; ?>
    <?php endif; ?>
    <article class="post-content">

    <div class="post-info-container">

    <div class="post-info">

    <?php if ($params->get('show_title', 1)) : ?>

        <h2 class="TzBlogTitle" itemprop="name">

            <?php if ($params->get('link_titles', 1) && $params->get('access-view')) : ?>
                <a class="main-color <?php if ($params->get('tz_use_lightbox') == 1) echo ' fancybox fancybox.iframe'; ?> "
                   href="<?php echo $blogLink; ?>" itemprop="url">
                    <?php echo $this->escape($this->item->title); ?>
                </a>
            <?php else : ?>
                <?php echo $this->escape($this->item->title); ?>
            <?php endif; ?>

            <?php if ($this->item->featured == 1): ?>
                <span class="label label-important TzFeature">
                    <?php echo JText::_('COM_TZ_PORTFOLIO_FEATURE'); ?>
                </span>
            <?php endif; ?>

        </h2>

    <?php endif; ?>

    <?php if (($params->get('show_author', 1)) or ($params->get('show_category', 1)) or ($params->get('show_create_date', 1)) or ($params->get('show_modify_date', 1)) or ($params->get('show_publish_date', 1)) or ($params->get('show_parent_category', 1)) or ($params->get('show_hits', 1)) or ($params->get('show_vote', 1))) : ?>
        <ul class="post-meta">

            <?php if ($params->get('show_vote', 1) AND $this->item->event->TZPortfolioVote): ?>
                <li>
                    <span>
                        <?php echo JText::_('COM_TZ_PORTFOLIO_RATING'); ?>
                    </span>
                    <?php echo $this->item->event->TZPortfolioVote; ?>
                </li>
            <?php endif; ?>

            <?php if ($params->get('show_author', 1) && !empty($this->item->author)) : ?>

                <li class="TzBlogCreatedby" itemprop="author" itemscope itemtype="http://schema.org/Person">
                    <?php $author = $this->item->author; ?>
                    <?php $author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author); ?>
                    <?php $author = '<span itemprop="name">' . $author . '</span>'; ?>
                    <?php if (!$userItemid = '&Itemid=' . $this->FindUserItemId($this->item->created_by)) {
                        $userItemid = null;
                    } ?>
                    <?php if ($params->get('link_author') == true): ?>
                        <?php echo JText::_('TPL_EXEC_WRITTEN_BY'); ?>
                        <?php echo JHtml::_('link', JRoute::_('index.php?option=com_tz_portfolio&amp;view=users&amp;created_by=' . $this->item->created_by . $userItemid), $author, array('itemprop' => 'url')); ?>
                    <?php else : ?>
                        <?php echo JText::_('TPL_EXEC_WRITTEN_BY'); ?>
                        <?php echo $author; ?>
                    <?php endif; ?>
                </li>
            <?php endif; ?>

            <?php if ($params->get('show_hits')) : ?>
                <li>
                    <?php echo JText::_('TPL_EXEC_ARTICLE_HITS'); ?>
                    <?php echo $this->item->hits; ?>
                    <meta itemprop="interactionCount"
                          content="UserPageVisits:<?php echo $this->item->hits; ?>"/>
                </li>
            <?php endif; ?>

            <?php if ($params->get('show_parent_category') && $this->item->parent_id != 1) : ?>
                <li>
                    <?php $title = $this->escape($this->item->parent_title); ?>
                    <?php $url = '<a href="' . JRoute::_(TZ_PortfolioHelperRoute::getCategoryRoute($this->item->parent_id)) . '" itemprop="genre">' . $title . '</a>'; ?>
                    <?php if ($params->get('link_parent_category')) : ?>
                        <?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
                    <?php else : ?>
                        <?php echo JText::sprintf('COM_CONTENT_PARENT', '<span itemprop="genre">' . $title . '</span>'); ?>
                    <?php endif; ?>
                </li>
            <?php endif; ?>

            <?php if ($params->get('show_category', 1)) : ?>
                <li>
                    <?php $title = $this->escape($this->item->category_title); ?>
                    <?php $url = '<a href="' . JRoute::_(TZ_PortfolioHelperRoute::getCategoryRoute($this->item->catid)) . '" itemprop="genre">' . $title . '</a>'; ?>
                    <?php if ($params->get('link_category', 1)) : ?>
                        <?php echo JText::sprintf('TPL_EXEC_CATEGORY', $url); ?>
                    <?php else : ?>
                        <?php echo JText::sprintf('TPL_EXEC_CATEGORY', '<span itemprop="genre">' . $title . '</span>'); ?>
                    <?php endif; ?>
                </li>
            <?php endif; ?>

            <?php if ($params->get('show_modify_date', 1)) : ?>
                <li itemprop="dateModified">
                    <?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
                </li>
            <?php endif; ?>

            <?php if ($params->get('show_publish_date', 1)) : ?>
                <li itemprop="datePublished">
                    <?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC2'))); ?>
                </li>
            <?php endif; ?>

            <?php if ($params->get('tz_show_count_comment', 1) == 1): ?>
                <li itemprop="comment" itemscope itemtype="http://schema.org/Comment">
                    <?php echo JText::_('TPL_EXEC_PORTFOLIO_COMMENT_COUNT'); ?>
                    <?php if ($params->get('comment_function_type', 'js') == 'js'): ?>
                        <?php if ($params->get('tz_comment_type') == 'disqus'): ?>
                            <a href="<?php echo $this->item->fullLink; ?>#disqus_thread"
                               itemprop="commentCount">
                                <?php echo $this->item->commentCount; ?>
                            </a>
                        <?php elseif ($params->get('tz_comment_type') == 'facebook'): ?>
                            <span class="fb-comments-count" data-href="<?php echo $this->item->fullLink; ?>"
                                  itemprop="commentCount"></span>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if ($params->get('tz_comment_type') == 'facebook'): ?>
                            <?php if (isset($this->item->commentCount)): ?>
                                <span itemprop="commentCount">
                                    <?php echo $this->item->commentCount; ?>
                                </span>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ($params->get('tz_comment_type') == 'disqus'): ?>
                            <?php if (isset($this->item->commentCount)): ?>
                                <span itemprop="commentCount">
                                    <?php echo $this->item->commentCount; ?>
                                </span>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if ($params->get('tz_comment_type') == 'jcomment'): ?>
                        <?php $comments = JPATH_SITE . '/components/com_jcomments/jcomments.php'; ?>
                        <?php if (file_exists($comments)) {
                            require_once($comments); ?>
                            <?php if (class_exists('JComments')) { ?>
                                <span itemprop="commentCount">
                                    <?php echo JComments::getCommentsCount((int)$this->item->id, 'com_tz_portfolio'); ?>
                                </span>
                            <?php } ?>
                        <?php } ?>
                    <?php endif; ?>
                </li>
            <?php endif; ?>
        </ul>
    <?php endif; ?>

    </div>

    </div>

    <?php if ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit) : ?>

        <div class="TzIcon">

            <div class="btn-group pull-right">

                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">

                    <i class="icon-cog"></i>
                    <span class="caret"></span>

                </a>

                <ul class="dropdown-menu">

                    <?php if ($params->get('show_print_icon')) : ?>

                        <li class="print-icon"> <?php echo JHtml::_('icon.print_popup', $this->item, $params); ?> </li>

                    <?php endif; ?>

                    <?php if ($params->get('show_email_icon')) : ?>

                        <li class="email-icon"> <?php echo JHtml::_('icon.email', $this->item, $params); ?> </li>

                    <?php endif; ?>

                    <?php if ($canEdit) : ?>

                        <li class="edit-icon"> <?php echo JHtml::_('icon.edit', $this->item, $params); ?> </li>

                    <?php endif; ?>

                </ul>

            </div>

        </div>

    <?php endif; ?>

    <?php if (!$params->get('show_intro', 1)) : ?>
        <!---- Call event onContentAfterTitle and TZPluginDisplayTitle on plugin -->
        <?php echo $this->item->event->afterDisplayTitle; ?>
        <?php echo $this->item->event->TZafterDisplayTitle; ?>
    <?php endif; ?>

    <?php // to do not that elegant would be nice to group the params ?>

    <?php
    $extraFields = $this->extraFields;
    $extraFields->setState('article.id', $this->item->id);
    $extraFields->setState('category.id', $this->item->catid);
    $extraFields->setState('orderby', $params->get('fields_order'));
    $extraParams = $extraFields->getParams();
    $extraFields->setState('params', $params);
    $this->assign('listFields', $extraFields->getExtraFields());
    ?>
    <?php echo $this->loadTemplate('extrafields'); ?>

    <!---- //Call event onContentBeforeDisplay and onTZPluginBeforeDisplay on plugin --->
    <?php echo $this->item->event->beforeDisplayContent; ?>
    <?php echo $this->item->event->TZbeforeDisplayContent; ?>

    <?php if ($this->item->introtext): ?>
        <p itemprop="description">
            <?php echo strip_tags($this->item->introtext); ?>
            <?php if ($params->get('show_readmore', 1) && $this->item->readmore) : ?>

                <?php if ($params->get('access-view')) : ?>

                    <?php $link = $blogLink; ?>

                <?php else : ?>

                    <?php $menu = JFactory::getApplication()->getMenu(); ?>

                    <?php $active = $menu->getActive(); ?>

                    <?php $itemId = $active->id; ?>

                    <?php $link1 = JRoute::_('index.php?option=com_users&amp;view=login&amp;Itemid=' . $itemId); ?>

                    <?php $returnURL = $blogLink; ?>

                    <?php $link = new JURI($link1); ?>

                    <?php $link->setVar('return', base64_encode($returnURL)); ?>

                <?php endif; ?>

                <?php if ($params->get('show_readmore', 1) == 1): ?>

                    <a class="read-more<?php if ($params->get('tz_use_lightbox') == 1) echo ' fancybox fancybox.iframe'; ?>"
                       href="<?php echo $link; ?>">

                        <?php if (!$params->get('access-view')) : ?>

                            <?php echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE'); ?>

                        <?php elseif ($readmore = $this->item->alternative_readmore) : ?>

                            <?php echo $readmore; ?>

                            <?php if ($params->get('show_readmore_title', 0) != 0) : ?>

                                <?php echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit')); ?>

                            <?php endif; ?>

                        <?php
                        elseif ($params->get('show_readmore_title', 0) == 0) : ?>

                            <?php echo JText::sprintf('TPL_EXEC_READ_MORE_TITLE'); ?>

                        <?php
                        else : ?>

                            <?php echo JText::_('COM_CONTENT_READ_MORE'); ?>

                            <?php echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit')); ?>

                        <?php endif; ?>

                    </a>

                <?php endif; ?>

            <?php endif; ?>

        </p>

    <?php endif; ?>

    <!---- //Call event onContentAfterDisplay and onTZPluginAfterDisplay on plugin -->

    <?php echo $this->item->event->afterDisplayContent; ?>
    <?php echo $this->item->event->TZafterDisplayContent; ?>

    </article>
    <?php if ($params_template->get('type_blog') == 3 or $params_template->get('type_blog') == 1): ?>
    </div>
    </div>
<?php endif; ?>

    <div class="item-separator"></div>

<?php else: ?>

    <?php if ($canEdit) : ?>

        <div class="TzIcon">

            <div class="btn-group pull-right">

                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="icon-cog"></i>
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">

                    <?php if ($canEdit) : ?>

                        <li class="edit-icon"> <?php echo JHtml::_('icon.edit', $this->item, $params); ?> </li>

                    <?php endif; ?>

                </ul>

            </div>

        </div>

    <?php endif; ?>

    <?php echo $this->loadTemplate('link'); ?>

    <?php echo $this->loadTemplate('quote'); ?>

<?php endif; ?>
<?php if ($this->item->state == 0) : ?>
    </div>
<?php endif; ?>