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
$class = null;
if ($params->get('tz_use_lightbox', 1) == 1) {
    $class = ' class = "fancybox fancybox.iframe"';
}
?>
<?php if ($media): ?>
    <?php if (!empty($media[0]->images) OR !empty($media[0]->thumb)): ?>
        <?php if ($params->get('show_image') == 1): ?>
            <?php
            if ($media[0]->type == 'image'):
                $src = '';

                if ($params->get('article_leading_image_resize')) {
                    if (!empty($media[0]->images))
                        $src = JURI::root() . str_replace('.' . JFile::getExt($media[0]->images),
                                '_' . $params->get('article_leading_image_resize')
                                . '.' . JFile::getExt($media[0]->images), $media[0]->images);

                    if (!empty($media[0]->images_hover))
                        $srcHover = str_replace('.' . JFile::getExt($media[0]->images_hover), '_'
                            . $params->get('article_leading_image_resize')
                            . '.' . JFile::getExt($media[0]->images_hover), $media[0]->images_hover);
                }
                if ($params->get('article_secondary_image_resize')) {
                    if (!empty($media[0]->images))
                        $src = JURI::root() . str_replace('.' . JFile::getExt($media[0]->images),
                                '_' . $params->get('article_secondary_image_resize')
                                . '.' . JFile::getExt($media[0]->images), $media[0]->images);

                    if (!empty($media[0]->images_hover))
                        $srcHover = str_replace('.' . JFile::getExt($media[0]->images_hover), '_'
                            . $params->get('article_secondary_image_resize')
                            . '.' . JFile::getExt($media[0]->images_hover), $media[0]->images_hover);
                }
                ?>

                <img src="<?php echo $src; ?>"
                     alt="<?php if (isset($media[0]->imagetitle)) echo $media[0]->imagetitle; ?>"
                     title="<?php if (isset($media[0]->imagetitle)) echo $media[0]->imagetitle; ?>"
                     itemprop="thumbnailUrl"/>
                <?php if ($params->get('tz_use_image_hover', 1) == 1): ?>
                <?php if (isset($srcHover)): ?>
                    <img class="tz_image_hover"
                         src="<?php echo $srcHover; ?>"
                         alt="<?php echo ($media[0]->imagetitle) ? ($media[0]->imagetitle) : ($this->item->title); ?>"
                         title="<?php echo ($media[0]->imagetitle) ? ($media[0]->imagetitle) : ($this->item->title); ?>"/>
                <?php endif; ?>
            <?php endif; ?>

            <?php endif; ?>
        <?php endif; ?>

        <?php if ($params->get('show_image_gallery', 1) == 1): ?>
            <?php
            if ($media[0]->type == 'imagegallery'):
                $srcgallery = null;
                if ($params->get('article_leading_image_gallery_resize')) {
                    if (!empty($media[0]->images))
                        $srcgallery = JURI::root() . str_replace('.' . JFile::getExt($media[0]->images),
                                '_' . $params->get('article_leading_image_gallery_resize')
                                . '.' . JFile::getExt($media[0]->images), $media[0]->images);
                }
                if ($params->get('article_secondary_image_gallery_resize')) {
                    if (!empty($media[0]->images))
                        $srcgallery = JURI::root() . str_replace('.' . JFile::getExt($media[0]->images),
                                '_' . $params->get('article_secondary_image_gallery_resize')
                                . '.' . JFile::getExt($media[0]->images), $media[0]->images);
                }
                ?>


                <img src="<?php echo $srcgallery; ?>"
                     alt="<?php echo ($media[0]->imagetitle) ? ($media[0]->imagetitle) : ($this->item->title); ?>"
                     title="<?php echo ($media[0]->imagetitle) ? ($media[0]->imagetitle) : ($this->item->title); ?>"
                     itemprop="thumbnailUrl"/>


            <?php endif; ?>
        <?php endif; ?>

        <?php if ($params->get('show_video', 1) == 1): ?>
            <?php if ($media[0]->type == 'video'): ?>
                <div class="tz_portfolio_video" itemprop="video" itemscope itemtype="http://schema.org/VideoObject">
                    <?php
                    switch ($media[0]->from):
                        case 'default':
                            echo $media[0]->images;
                            break;
                        case 'vimeo':
                            ?>
                            <iframe
                                src="http://player.vimeo.com/video/<?php echo $media[0]->images; ?>?title=0&amp;byline=0&amp;portrait=0&amp;wmode=transparent"
                                width="<?php echo ($params -> get('video_width'))?$params -> get('video_width'):'100%';?>"
                                height="<?php echo ($params -> get('video_height'))?$params -> get('video_height'):'300px';?>"
                                frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen
                                itemprop="embedUrl">
                            </iframe>
                            <?php
                            break;
                        case 'youtube':
                            ?>
                            <iframe
                                width="<?php echo ($params -> get('video_width'))?$params -> get('video_width'):'100%';?>"
                                height="<?php echo ($params -> get('video_height'))?$params -> get('video_height'):'300px';?>"
                                src="http://www.youtube.com/embed/<?php echo $media[0]->images; ?><?php echo (!empty($media[0]->imagetitle)) ? '?title=' . $media[0]->imagetitle : ''; ?>"
                                frameborder="0" allowfullscreen wmode="transparent" itemprop="embedUrl">
                            </iframe>
                            <?php break; ?>
                        <?php endswitch; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php // Require audio?>
        <?php if ($params->get('audio_layout_type', 'thumbnail') == 'thumbnail'): ?>
            <?php echo $this->loadTemplate('audio_thumb'); ?>
        <?php else: ?>
            <?php echo $this->loadTemplate('audio'); ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>