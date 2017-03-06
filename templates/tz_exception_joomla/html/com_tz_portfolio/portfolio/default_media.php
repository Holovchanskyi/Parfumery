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

defined('_JEXEC') or die();

$media = $this->listMedia;
$link = $this->item->link;
$params = $this->item->params;
$imgSize = null;
$src = null;
$src_media = null;
if ($params->get('portfolio_image_size', 'M')) {
    $imgSize = $params->get('portfolio_image_size', 'M');
}
if (isset($media[0]->featured) && $media[0]->featured == 1) {
    if ($params->get('portfolio_image_featured_size', 'M')) {
        $imgSize = $params->get('portfolio_image_featured_size', 'L');
    }
}
if ($imgSize) {
    if (!empty($media[0]->images))
        $src = str_replace('.' . JFile::getExt($media[0]->images), '_' . $imgSize
            . '.' . JFile::getExt($media[0]->images), $media[0]->images);

    if (!empty($media[0]->images_hover))
        $srcHover = JURI::root() . str_replace('.' . JFile::getExt($media[0]->images_hover), '_'
                . $imgSize
                . '.' . JFile::getExt($media[0]->images_hover), $media[0]->images_hover);
}
$class = null;
if ($params->get('tz_use_lightbox', 1) == 1) {
    $class = ' class = "fancybox fancybox.iframe"';
}
?>
<?php if ($params->get('show_image', 1) OR $params->get('show_image_gallery', 1) OR $params->get('show_video', 1)
    OR $params->get('show_audio', 1)
):?>
    <?php if ($media): ?>
        <?php if (!empty($media[0]->images) OR !empty($media[0]->thumb)): ?>
            <div class="img-holder">

                <?php if ($params->get('show_image')): ?>
                    <?php if ($media[0]->type == 'image'): ?>
                        <?php if ($src): $src = JURI::root() . $src;
                            $src_media = $src; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($params->get('show_image_gallery')): ?>
                    <?php if ($media[0]->type == 'imagegallery'): ?>
                        <?php if ($src):  $src_media = $src; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>


                <?php if ($params->get('show_video')): ?>
                    <?php
                    if ($media[0]->type == 'video'):
                        $srcVideo = null;
                        $thbSize = null;
                        if ($params->get('portfolio_image_size', 'M')) {
                            $thbSize = $params->get('portfolio_image_size', 'M');
                        }
                        if ($media[0]->featured && $media[0]->featured == 1) {
                            if ($params->get('portfolio_image_featured_size', 'M')) {
                                $thbSize = $params->get('portfolio_image_featured_size', 'L');
                            }
                        }
                        if ($thbSize) {
                            $srcVideo = JURI::root() . str_replace('.' . JFile::getExt($media[0]->thumb), '_'
                                    . $thbSize
                                    . '.' . JFile::getExt($media[0]->thumb), $media[0]->thumb);
                        }
                        $src_media = $srcVideo;
                        ?>
                    <?php endif; ?>
                <?php endif; ?>

                <?php // Require audio?>
                <?php if ($params->get('audio_layout_type', 'thumbnail') == 'thumbnail'): ?>
                    <?php echo $this->loadTemplate('audio_thumb'); ?>
                <?php else: ?>
                    <?php echo $this->loadTemplate('audio'); ?>
                <?php endif; ?>
                <div class="img-over">
                    <a href="<?php echo $link ?>" class="fx link"><b class="fa fa-link"></b></a>
                    <a href="<?php echo $src_media ?>" class="fx zoom" title="Project Title"><b
                            class="fa fa-search-plus"></b></a>
                </div>
                <img src="<?php echo $src_media; ?>"
                     title="<?php echo ($media[0]->imagetitle) ? ($media[0]->imagetitle) : ($this->item->title); ?>"
                     alt="<?php echo ($media[0]->imagetitle) ? ($media[0]->imagetitle) : ($this->item->title); ?>"
                     itemprop="thumbnailUrl"/>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>