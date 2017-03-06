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
$bg_new = ".bg-slide-new {
    background-image:url(" .JUri::base(). $params->get('background_news') . ");
    background-repeat:no-repeat;
}";
$document->addStyleDeclaration($bg_new);
?>
<div class="Newsslider ">
    <?php if (isset($list) && !empty($list)) :
        foreach ($list as $item) :
            $media = $item->media; ?>
            <?php if ($item->type_media != 'quote' AND $item->type_media != 'link' AND $item->type_media != 'audio'): ?>
            <div>
                <?php if ($image == 1 AND $item->image != null) : ?>
                    <a href="<?php echo $item->link; ?>" class="cell-9" title="<?php echo $item->title; ?>">
                        <?php $title_image = $item->title; ?>
                        <img src="<?php echo $item->image; ?>"
                             title="<?php echo $title_image; ?>"
                             alt="<?php echo $title_image; ?>"/>
                    </a>
                <?php endif; ?>
                <article class="post-content cell-3">
                    <?php if ($title == 1 or $date == 1 or $hits == 1 or $author_new == 1 or $cats_new == 1) : ?>
                        <div class="post-info-container">
                            <div class="post-info">
                                <?php if ($title == 1): ?>
                                    <h2>
                                        <a href="<?php echo $item->link; ?>" title="<?php echo $item->title; ?>"
                                           class="main-color">
                                            <?php echo $item->title; ?>
                                        </a>
                                    </h2>
                                <?php endif; ?>
                                <ul class="post-meta">
                                    <li class="meta-user">
                                        <?php if ($author_new == 1): ?>

                                            <?php echo JText::sprintf('MOD_TZ_NEWS_AUTHOR_1', '<a>' . $item->author . '</a>'); ?>

                                        <?php endif; ?>
                                        <?php if ($cats_new == 1): ?>

                                            <?php echo JText::sprintf('MOD_TZ_NEWS_CATEGORY_1', '<a>' . $item->category . '</a>'); ?>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                                <?php if ($date == 1) : ?>

                                    <span class="project-options">
                                <?php echo JText::sprintf('MOD_TZ_NEWS_DATE_ALL', JHtml::_('date', $item->created, JText::_('MOD_TZ_NEWS_DATE_FOMAT'))); ?>
                            </span>

                                <?php endif; ?>
                                <?php if ($hits == 1) : ?>

                                    <span class="project-options">
                                <?php echo JText::sprintf('MOD_TZ_NEWS_HIST_LIST', $item->hit) ?>
                            </span>

                                <?php endif; ?>


                                <?php if ($des == 1) : ?>

                                    <?php if ($limittext) :
                                        echo substr($item->intro, 3, $limittext);
                                    else :
                                        echo $item->intro;
                                    endif;?>
                                <?php endif; ?>
                                <?php if ($readmore == 1) : ?>
                                    <a href="<?php echo $item->link; ?>" class="read-more main-bg">
                                        <?php echo JText::_('MOD_TZ_NEWS_READ_MORE') ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </article>

                <div class="clearfix"></div>
            </div>
        <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?php if ($params->get('show_button_all') == 1): ?>
    <div class="view-all-projects">
        <a href="<?php echo $params->get('link_recent'); ?>"><?php echo $params->get('text_recent'); ?></a>
    </div>
<?php endif; ?>
<?php
$repsonsive = explode(',', $params->get('responsive'));
$repsonsive_scroll = explode(',', $params->get('slidesToScroll_responsive'));
$repsonsive_show = explode(',', $params->get('slidesToShow_responsive'));
if ($params->get('dots') == 1) {
    $dots = 'true';
} else {
    $dots = 'false';
}
if ($params->get('infinite') == 1) {
    $infinite = 'true';
} else {
    $infinite = 'false';
}
if ($params->get('touchMove') == 1) {
    $touchMove = 'true';
} else {
    $touchMove = 'false';
}
?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('a.zoom').prettyPhoto({social_tools: false});
        jQuery('.Newsslider').slick({
            dots: <?php echo $dots?>,
            infinite: <?php echo $infinite?>,
            speed: <?php echo $params->get('speed','300');?>,
            slidesToShow: <?php echo $params->get('slidesToShow','5');?>,
            touchMove: <?php echo $touchMove?>,
            slidesToScroll: <?php echo $params->get('slidesToScroll','5');?>,
            responsive: [
                <?php for($j =0; $j <count($repsonsive); $j++): ?>
                {
                    breakpoint: <?php echo $repsonsive[$j]?>,
                    settings: {
                        slidesToShow: <?php echo isset($repsonsive_show[$j]) ?  $repsonsive_show[$j]: 1?>,
                        slidesToScroll: <?php echo isset($repsonsive_scroll[$j])?  $repsonsive_scroll[$j]: 1?>
                    }
                }<?php if($j != count($repsonsive)-1):?>,
                <?php endif;?>
                <?php endfor;?>
            ]
        });
        jQuery('.slick-slide').each(function () {
            var $this = jQuery(this),
                $index = $this.index(),
                contents = $this.find('.img-over');
            $this.hover(function () {
                contents.fadeIn(400).find('.link').removeClass('animated fadeOutUp').addClass('animated fadeInDown');
                contents.find('.zoom').removeClass('animated fadeOutDown').addClass('animated fadeInUp');
                return false;
            }, function () {
                contents.fadeOut(400).find('.link').removeClass('animated fadeInDown').addClass('animated fadeOutUp');
                contents.find('.zoom').removeClass('animated fadeInUp').addClass('animated fadeOutDown');
                return false;
            });
        });
    });

</script>