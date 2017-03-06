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
$doc = JFactory::getDocument();
$socialInfos = $this->socialInfo;
$media = $this->listMedia;
$url = urlencode($this->item->fullLink);
//$url    = 'http://www.templaza.com';
$img = '';

if ($media[0]->type == 'image' or $media[0]->type == 'imagegallery') {
    $img = $media[0]->images;
}
if ($media[0]->type == 'audio') {
    $img = $media[0]->thumb;
}
if ($media[0]->type == 'video') {
    $img = $media[0]->thumb;
}
?>
<?php if (($params->get('show_twitter_button', 1) == 1) OR ($params->get('show_facebook_button', 1) == 1)
    OR ($params->get('show_google_button', 1) == 1) OR $params->get('show_pinterest_button', 1)
    OR $params->get('show_linkedin_button', 1)
):?>
    <li class="social">
        <div class=" social_title">
            <i class="<?php echo JText::_('ICON_SOCIAL_NETWORK_PORTFOLIO_SINGLE'); ?>"></i>
            <span class="main-color"><?php echo JText::_('SOCIAL_NETWORK_PORTFOLIO_SINGLE'); ?></span>
        </div>
        <div class="social_button">
            <!-- Facebook Button -->
            <?php if ($params->get('show_facebook_button', 1) == 1): ?>
                <a href="javascript:"
                   onclick="popUp=window.open('http://www.facebook.com/sharer.php?u=<?php echo $url; ?>', 'popupwindow', 'scrollbars=yes,width=800,height=400');popUp.focus();return false"
                   class="btn"
                   data-title="Facebook"
                   data-tooltip="true">
                    <i class="<?php echo JText::_('TPL_EXECPTION_ICON_FACEBOOK'); ?>"></i>
                </a>
            <?php endif; ?>
            <!-- End Facebook Button -->
            <!-- Twitter Button -->
            <?php if ($params->get('show_twitter_button', 1) == 1): ?>
                <a href="javascript:"
                   onclick="popUp=window.open('https://twitter.com/intent/tweet?url=<?php echo $url; ?>&amp;via=Templaza&amp;text=<?php echo $this->item->title ?>', 'popupwindow', 'scrollbars=yes,width=800,height=400');popUp.focus();return false"
                   class="btn"
                   data-title="Twitter"
                   data-tooltip="true">
                    <i class="<?php echo JText::_('TPL_EXECPTION_ICON_TWITTER'); ?>"></i>
                </a>
            <?php endif; ?>
            <!-- End Twitter Button -->
            <!-- Google +1 Button -->
            <?php if ($params->get('show_google_button', 1) == 1): ?>
                <a href="javascript:"
                   onclick="popUp=window.open('https://plus.google.com/share?url=<?php echo $url; ?>&amp;hl=en', 'popupwindow', 'scrollbars=yes,width=900,height=600,top='+(screen.height-600)/2+',left='+(screen.width-900)/2);popUp.focus();return false"
                   class="btn"
                   data-title="Google"
                   data-tooltip="true">
                    <i class="<?php echo JText::_('TPL_EXECPTION_ICON_GOOGLE'); ?>"></i>
                </a>
            <?php endif; ?>
            <!-- Google +1 Button -->
            <!-- Pinterest Button -->
            <?php if ($params->get('show_pinterest_button', 1)): ?>
                <a href="javascript:"
                   onclick="popUp=window.open('http://pinterest.com/pin/create/button/?url=<?php echo $url; ?>&amp;media=<?php echo $img; ?>&amp;description=<?php echo $this->item->introtext ?>', 'popupwindow', 'scrollbars=yes,width=800,height=450'); popUp.focus();return false"
                   class="btn"
                   data-title="Pinterest"
                   data-tooltip="true">
                    <i class="<?php echo JText::_('TPL_EXECPTION_ICON_PINTEREST'); ?>"></i>
                </a>
            <?php endif; ?>
            <!-- Pinterest Button -->
            <!-- Linkedin Button -->
            <?php if ($params->get('show_linkedin_button', 1)): ?>
                <a href="javascript:"
                   onclick="popUp=window.open('http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&amp;title=<?php echo $this->item->title ?>&amp;source=Templaza', 'popupwindow', 'scrollbars=yes,width=1000,height=400'); popUp.focus();return false"
                   class="btn"
                   data-title="Linkedin"
                   data-tooltip="true">
                    <i class="<?php echo JText::_('TPL_EXECPTION_ICON_LINKEDIN'); ?>"></i>
                </a>
            <?php endif; ?>
            <!-- Linkedin Button -->
        </div>
    </li>
<?php endif; ?>