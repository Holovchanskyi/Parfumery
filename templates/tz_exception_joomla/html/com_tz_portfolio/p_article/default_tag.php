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
defined('_JEXEC') or die('Restricted access');

$params = $this->item->params;
$tmpl = JRequest::getString('tmpl');

?>
<?php if ($params->get('show_tags', 1)): ?>
    <?php if ($this->listTags): ?>
        <li>

            <i class="<?php echo JText::_('ICON_TAG_PORTFOLIO_SINGLE') ?>"></i>
                <span class="main-color">
                    <?php echo JText::_('TAG_PORTFOLIO_SINGLE') ?>
                </span>

            <div class="TzArticleTag ">
                <?php foreach ($this->listTags as $i => $row): ?>
                    <?php $itemId = $this->FindItemId($row->id); ?>
                    <?php $link = JRoute::_('index.php?option=com_tz_portfolio&view=tags&id=' . $row->id . '&Itemid=' . $itemId); ?>

                    <a class="label<?php echo $i ?>"
                       href="<?php echo $link; ?>"<?php if (isset($tmpl) AND !empty($tmpl)): echo ' target="_blank"'; endif; ?>
                       itemprop="keywords">
                        <?php echo $row->name; ?>
                    </a>
                    <?php if ($i != count($this->listTags) - 1) {
                        echo ',';
                    } ?>
                <?php endforeach; ?>

            </div>

        </li>
    <?php endif; ?>
<?php endif; ?>
