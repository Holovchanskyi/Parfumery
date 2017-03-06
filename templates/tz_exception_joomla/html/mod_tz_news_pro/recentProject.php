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
?>
<div class="cell-3 recent_left recent">
    <?php echo $params->get('title_recent'); ?>
    <?php echo $params->get('desc_recent'); ?>
    <div class="viewAll">
        <a class="btn" href="<?php echo $params->get('link_recent'); ?>"><?php echo $params->get('text_recent'); ?></a>
    </div>
</div>
<div class="cell-9 recent_right recent">
    <div class="homeGallery portfolio">
        <?php if (isset($list) && !empty($list)) :
            foreach ($list as $item) :
                $media = $item->media; ?>
                <?php if ($item->type_media != 'quote' AND $item->type_media != 'link' AND $item->type_media != 'audio'): ?>
                <div>
                    <div class="portfolio-item">
                        <?php if ($image == 1 AND $item->image != null) : ?>
                            <div class="img-holder">
                                <div class="img-over">
                                    <?php $title_image = $item->title; ?>
                                    <a href="<?php echo $item->link; ?>" class="fx link">
                                        <b class="fa fa-link"></b>
                                    </a>
                                    <a href="<?php echo $item->image; ?>" class="fx zoom" data-gal="prettyPhoto[pp_gal]"
                                       title="<?php echo $title_image; ?>">
                                        <b class="fa fa-search-plus"></b>
                                    </a>
                                </div>
                                <img src="<?php echo $item->image; ?>"
                                     title="<?php echo $title_image; ?>"
                                     alt="<?php echo $title_image; ?>"/>
                            </div>
                        <?php endif; ?>
                        <?php if ($title == 1 or $des == 1 or $date == 1 or $hits == 1 or $author_new == 1 or $cats_new == 1): ?>
                            <div class="name-holder">
                                <?php if ($title == 1 ) : ?>
                                    <a href="<?php echo $item->link; ?>"
                                       title="<?php echo $item->title; ?>" class="project-name">
                                        <?php echo $item->title; ?>
                                    </a>
                                <?php endif; ?>
                                <?php if ($cats_new == 1): ?>
                                    <span class="project-options">
                                    <?php echo JText::sprintf('MOD_TZ_NEWS_CATEGORY', $item->category); ?>
                                </span>
                                <?php endif; ?>
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
                                <?php if ($author_new == 1): ?>
                                    <span class="project-options">
                                    <?php echo JText::sprintf('MOD_TZ_NEWS_AUTHOR', $item->author); ?>
                                </span>
                                <?php endif; ?>
                                <?php if ($des == 1) : ?>
                                    <span class="project-options">
                                    <?php if ($limittext) :
                                        echo substr($item->intro, 3, $limittext);
                                    else :
                                        echo $item->intro;
                                    endif;?>
                                        <?php if ($readmore == 1) : ?>
                                            <span class="project-options">
                                            <a href="<?php echo $item->link; ?>">
                                                <?php echo JText::_('MOD_TZ_NEWS_READ_MORE') ?>
                                            </a>
                                        </span>
                                        <?php endif; ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
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
        jQuery('.homeGallery').slick({
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