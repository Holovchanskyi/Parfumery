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

$params = $this->item->params;
?>
<?php if ($params->get('show_create_date', 1)) : ?>
    <li itemprop="dateCreated">
        <i class="<?php echo JText::_('ICON_DATE_CREATE_PORTFOLIO_SINGLE')?>"></i> <span class="main-color"><?php echo JText::_('DATE_CREATE_PORTFOLIO_SINGLE')?></span>
        <?php echo JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC3')); ?>

    </li>
<?php endif; ?>