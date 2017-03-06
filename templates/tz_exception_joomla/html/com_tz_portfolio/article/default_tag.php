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
        <div class="post-tags">

<?php echo JText::_('TPL_EXEC_TAG_BLOG');?>
            <!--    <a href="#">Responsive</a>,<a> Business</a>,<a href="#"> HTML</a>,<a> Design</a>,<a> WordPress</a>-->

            <?php foreach ($this->listTags as $i => $row): ?>
                <?php $itemId = $this->FindItemId($row->id); ?>
                <?php $link = JRoute::_('index.php?option=com_tz_portfolio&view=tags&id=' . $row->id . '&Itemid=' . $itemId); ?>
                <!--        <span  class="tag-list--><?php //echo $i ?><!--" itemprop="keywords">-->
            <a href="<?php echo $link; ?>"<?php if (isset($tmpl) AND !empty($tmpl)): echo ' target="_blank"'; endif; ?>>
                <?php echo $row->name; ?>
                </a><?php if ($i < count($this->listTags) - 1) {
                    echo ',';
                } ?>
                <!--        </span>-->
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>
