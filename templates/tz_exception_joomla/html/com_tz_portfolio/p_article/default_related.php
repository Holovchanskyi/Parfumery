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
$doc = JFactory::getDocument();
JHtml::addIncludePath(PLAZART_TEMPLATE_REL . '/libraries/helpers');
$lists = $this->itemMore;
// Create shortcuts to some parameters.
$params = $this->item->params;
//var_dump($params);
if (isset($this->mparams)) {
    $params = $this->mparams;
    $params->merge($this->item->params);
}

$tmpl = null;
if ($params->get('tz_use_lightbox', 1) == 1) {
    $tmpl = '&tmpl=component';
}
if ($lists):
    if ($params->get('show_related_article', 1)):
        ?>
        <div class="TzRelated">
            <?php if ($params->get('show_related_heading', 1)): ?>
                <?php
                $title = JText::_('COM_TZ_PORTFOLIO_RELATED_ARTICLE');
                if ($params->get('related_heading')) {
                    $title = $params->get('related_heading');
                }
                ?>
                <h2 class="TzRelatedTitle"><?php echo $title; ?></h2>
            <?php endif; ?>
            <div class="portfolioGallery portfolio">
                <?php $media = JModelLegacy::getInstance('Media', 'TZ_PortfolioModel'); ?>
                <?php foreach ($lists as $i => $item): ?>
                    <?php

                    $tzRedirect = $params->get('tz_portfolio_redirect', 'p_article'); //Set params for $tzRedirect
                    $itemParams = new JRegistry($item->attribs); //Get Article's Params
                    //Check redirect to view article
                    if ($itemParams->get('tz_portfolio_redirect')) {
                        $tzRedirect = $itemParams->get('tz_portfolio_redirect');
                    }
                    if ($tzRedirect == 'article') {
                        $item->_link = JRoute::_(TZ_PortfolioHelperRoute::getArticleRoute($item->slug, $item->catid) . $tmpl);
                    } else {
                        $item->_link = JRoute::_(TZ_PortfolioHelperRoute::getPortfolioArticleRoute($item->slug, $item->catid) . $tmpl);
                    }

                    $listMedia = $media->getMedia($item->id);
                    $src = null;
                    if ($listMedia) {
                        if ($listMedia[0]->type != 'quote' && $listMedia[0]->type != 'link') {
                            if ($listMedia[0]->type == 'video' || $listMedia[0]->type == 'audio') {
                                $src = $listMedia[0]->thumb;
                            } else {
                                $src = $listMedia[0]->images;
                            }
                        }
                    }
                    ?>
                    <?php if (($params->get('show_related_type', 'title_image') == 'image' AND $src)
                        OR $params->get('show_related_type', 'title_image') == 'title'
                        OR $params->get('show_related_type', 'title_image') == 'title_image'
                    ):?>
                        <div class="TzItem<?php if ($i == 0) echo ' first';
                        if ($i == count($lists) - 1) echo ' last'; ?>">
                    <?php endif; ?>
                    <div class="portfolio-item">
                        <?php if ($params->get('show_related_type', 'title_image') == 'image'
                            OR $params->get('show_related_type', 'title_image') == 'title_image'
                        ):?>
                            <?php if ($src): ?>
                                <?php $size = $params->get('related_image_size', 'S');
                                $src = str_replace('.' . JFile::getExt($src), '_' . $size . '.' . JFile::getExt($src), $src); ?>
                                <div class="img-holder">
                                    <div class="img-over">
                                        <a  <?php if ($params->get('tz_use_lightbox', 1) == 1) {
                                            echo ' class="fancybox fancybox.iframe"';
                                        } ?>
                                            href="<?php echo $item->_link; ?>" class="fx link"><b
                                                class="fa fa-link"></b></a>
                                        <a href="<?php echo $src; ?>" class="fx zoom" data-gal="prettyPhoto[related]"
                                           title="<?php echo $item->title; ?>"><b class="fa fa-search-plus"></b></a>
                                    </div>
                                    <img src="<?php echo $src; ?>" alt="<?php echo $item->title; ?>"
                                         title="<?php echo $item->title; ?>"/>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="name-holder">
                            <?php if ($params->get('show_related_type', 'title_image') == 'title'
                                OR($params->get('show_related_type', 'title_image') == 'title_image')
                            ):?>

                                <a href="<?php echo $item->_link; ?>"
                                   class="project-name <?php if ($params->get('tz_use_lightbox', 1) == 1) {
                                       echo ' fancybox fancybox.iframe';
                                   } ?>">
                                    <?php echo $item->title; ?>
                                </a>

                            <?php endif; ?>
                            <?php $catArticle = JHtml::_('tz.getCate', $item->catid); ?>
                            <span class="project-options"><?php echo $catArticle->cat_title ?></span>
                        </div>
                    </div>
                    <?php if (($params->get('show_related_type', 'title_image') == 'image' AND $src)
                        OR $params->get('show_related_type', 'title_image') == 'title'
                        OR $params->get('show_related_type', 'title_image') == 'title_image'
                    ):?>
                        </div>
                    <?php endif; ?>

                <?php endforeach; ?>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function () {

                jQuery('.portfolioGallery').slick({
                    dots: false,
                    infinite: true,
                    speed: 300,
                    slidesToShow: <?php echo $params->get('related_limit')-2;?>,
                    touchMove: true,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 640,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
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
                jQuery('a.zoom').prettyPhoto({gallery_markup: true, social_tools: false});
            });

        </script>

    <?php endif; ?>
<?php endif; ?>