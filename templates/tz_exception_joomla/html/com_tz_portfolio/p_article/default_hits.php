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

$params = $this -> item -> params;
?>

<?php if ($params->get('show_hits',1)) : ?>
    <div class="cell-6 fx" data-animate="bounceIn">
        <div class="white-bg">
            <div class="fun-number main-color"><?php echo $this->item->hits; ?></div>
            <div class="fun-text"><?php echo JText::_('HITS_LABEL') ?></div>
            <meta itemprop="interactionCount" content="UserPageVisits:<?php echo $this->item->hits; ?>" />
        </div>
    </div>
<?php endif; ?>