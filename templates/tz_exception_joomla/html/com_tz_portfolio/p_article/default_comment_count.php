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

<?php if ($params->get('tz_show_count_comment', 1) == 1): ?>


    <div class="cell-6 fx" data-animate="bounceIn" data-animation-delay="200">
        <div class="white-bg">
            <div class="fun-number main-color">

                <?php if ($params->get('comment_function_type', 'js') == 'js'): ?>
                    <?php if ($params->get('tz_comment_type') == 'disqus'): ?>
                        <a href="<?php echo $this->item->link; ?>#disqus_thread"><?php echo $this->item->commentCount; ?></a>
                    <?php elseif ($params->get('tz_comment_type') == 'facebook'): ?>
                        <span class="fb-comments-count" data-href="<?php echo $this->item->link; ?>"></span>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if ($params->get('tz_comment_type') == 'facebook'): ?>
                        <?php if (isset($this->item->commentCount)): ?>
                            <?php echo $this->item->commentCount; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if ($params->get('tz_comment_type') == 'disqus'): ?>
                        <?php if (isset($this->item->commentCount)): ?>
                            <?php echo $this->item->commentCount; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>


                <?php
                $coutCm= '';
                if ($params->get('tz_comment_type') == 'jcomment'): ?>
                    <?php
                    $comments = JPATH_SITE . '/components/com_jcomments/jcomments.php';
                    if (file_exists($comments)) {
                        require_once($comments);
                        if (class_exists('JComments')) {
                            ?>
                            <?php
                            $coutCm = JComments::getCommentsCount((int)$this->item->id, 'com_tz_portfolio');
                            echo JComments::getCommentsCount((int)$this->item->id, 'com_tz_portfolio'); ?>
                        <?php
                        }
                    }
                    ?>
                <?php endif; ?>


            </div>
            <div class="fun-text">
                <?php if ($this->item->commentCount == 0 or (!$coutCm and $coutCm == 0)): ?>
                    <?php echo JText::_('COMMENT_LABEL') ?>
                <?php else: ?>
                    <?php echo JText::_('COMMENTS_LABEL') ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php endif; ?>