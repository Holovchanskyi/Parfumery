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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . '/templates/' . JFactory::getApplication()->getTemplate() . '/js/slick.min.js');
$doc->addScript(JUri::base() . '/templates/' . JFactory::getApplication()->getTemplate() . '/js/jquery.prettyPhoto.js');
// Create shortcuts to some parameters.
$params = $this->item->params;
$images = json_decode($this->item->images);
$urls = json_decode($this->item->urls);
$canEdit = $this->item->params->get('access-edit');
JHtml::_('behavior.caption');
$user = JFactory::getUser();

$tmpl = JRequest::getString('tmpl');
$params_template = JFactory::getApplication()->getTemplate(true)->params;
if ($tmpl) {
    $tmpl = '&tmpl=component';
}
?>
<div class="TzPortfolioItemPage item-page<?php echo $this->pageclass_sfx ?>" itemscope
     itemtype="http://schema.org/Article">
    <div class="TzItemPageInner">
        <meta itemprop="inLanguage"
              content="<?php echo ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language; ?>"/>
        <?php if ($this->params->get('show_page_heading', 1)) : ?>
            <h1 class="TzHeadingTitle">
                <?php echo $this->escape($this->params->get('page_heading')); ?>
            </h1>
        <?php endif; ?>
        <?php if ($params_template->get('use_p_article_layout_builder') == 1): ?>
            <?php echo $this->generateLayout; ?>
        <?php else: ?>
            <?php if ($params_template->get('type_p_article') == 1): ?>
                <div class="tz_p_article media">
                    <div class="container fx" data-animate="fadeInDown">
                        <?php echo $this->loadTemplate('media'); ?>
                    </div>
                </div>
                <div class=" tz_p_article sectionWrapper gry-bg margin-rep">
                    <div class="container">
                        <div class="row">
                            <div class="cell-3 fx" data-animate="fadeInLeft">
                                <h3 class="block-head"><?php echo JText::_('PROJECT_DETAILS') ?></h3>
                                <ul class="list-details">

                                    <?php echo $this->loadTemplate('category'); ?>

                                    <?php echo $this->loadTemplate('author_name'); ?>

                                    <?php echo $this->loadTemplate('created_date'); ?>

                                    <?php echo $this->loadTemplate('tag'); ?>

                                    <?php echo $this->loadTemplate('social_network'); ?>
                                </ul>
                            </div>
                            <div class="cell-6 fx project-info" data-animate="fadeInDown">
                                <h3 class="block-head"><?php echo JText::_('PROJECT_INFO') ?></h3>
                                <?php echo $this->loadTemplate('fulltext'); ?>
                            </div>
                            <div class="cell-3 porto-stats fx" data-animate="fadeInRight">
                                <h3 class="block-head"><?php echo JText::_('PROJECT_STATUS') ?></h3>

                                <div class="staff-3">
                                    <?php echo $this->loadTemplate('hits'); ?>
                                    <?php echo $this->loadTemplate('comment_count'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" tz_p_article related">
                    <div class="container">
                        <h3 class="block-head"><?php echo JText::_('RELATED_ARTICLE')?></h3>
                        <?php echo $this->loadTemplate('related'); ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="media tz_p_article">
                    <div class="container">
                        <div class="row">
                            <div class="cell-9 fx" data-animate="fadeInLeft">
                                <?php echo $this->loadTemplate('media'); ?>
                            </div>
                            <div class="cell-3 fx" data-animate="fadeInRight">
                                <h3 class="block-head"><?php echo JText::_('PROJECT_DETAILS') ?></h3>
                                <ul class="list-details">

                                    <?php echo $this->loadTemplate('category'); ?>

                                    <?php echo $this->loadTemplate('author_name'); ?>

                                    <?php echo $this->loadTemplate('created_date'); ?>

                                    <?php echo $this->loadTemplate('tag'); ?>

                                    <?php echo $this->loadTemplate('social_network'); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" tz_p_article sectionWrapper gry-bg margin-rep">
                    <div class="container">
                        <div class="row">
                            <div class="cell-9 fx" data-animate="fadeInUp">
                                <h3 class="block-head"><?php echo JText::_('PROJECT_INFO') ?></h3>
                                <?php echo $this->loadTemplate('fulltext'); ?>
                            </div>
                            <div class="cell-3 porto-stats">
                                <h3 class="block-head"><?php echo JText::_('PROJECT_STATUS') ?></h3>

                                <div class="staff-3">
                                    <?php echo $this->loadTemplate('hits'); ?>
                                    <?php echo $this->loadTemplate('comment_count'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="related tz_p_article">
                    <div class="container">
                        <h3 class="block-head"><?php echo JText::_('RELATED_ARTICLE')?></h3>
                        <?php echo $this->loadTemplate('related'); ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <?php
        //Call event onContentAfterDisplay and onTZPluginAfterDisplay on plugin
        echo $this->item->event->afterDisplayContent;
        echo $this->item->event->TZafterDisplayContent;
        ?>

    </div>
</div>