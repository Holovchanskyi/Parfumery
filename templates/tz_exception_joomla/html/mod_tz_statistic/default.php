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

//no direct access
defined('_JEXEC') or die();
if ($list):
    $background = $params->get('background', '');
    $doc = JFactory::getDocument();
    if ($params->get('textColor')) {
        $doc->addStyleDeclaration('#TzStatistic' . $module->id . '.TzStatistic{ color: ' . $params->get('textColor') . ';}');
        $doc->addStyleDeclaration('#TzStatistic' . $module->id . ' .percent{ color: ' .
            $params->get('textColor') . ';}');
    }
    if ($params->get('bgColor')) {
        $doc->addStyleDeclaration('#TzStatistic' . $module->id . ' .chart-inner{ background: ' .
            $params->get('bgColor') . ';}');
    }
    ?>
    <div id="TzStatistic<?php echo $module->id; ?>" class="TzStatistic<?php echo $moduleclass_sfx; ?> tz-video-exception ">


        <?php
        $videoMp4 = $params->get('video_mp4');
        $videoWebm = $params->get('video_webm');
        $videoOgg = $params->get('video_ogg');
        if (!$params->get('bg_type') AND ($videoMp4 OR $videoWebm OR $videoOgg)):?>
            <video autobuffer="autobuffer"
                <?php echo ($params->get('muted')) ? ' muted="muted"' : ''; ?>
                <?php echo ($params->get('loop')) ? ' loop="loop"' : ''; ?>
                <?php echo ($params->get('loop')) ? ' autoplay="autoplay"' : ''; ?> style="position: relative;">
                <source type="video/mp4" src="<?php echo JUri::base() . 'images/video/' . $videoMp4; ?>"/>
                <source type="video/webm" src="<?php echo JUri::base() . '/images/video/' . $videoWebm; ?>"/>
                <source type="video/ogg" src="<?php echo JUri::base() . '/images/video/' . $videoOgg; ?>"/>
                <object data="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf?volume_level=0"
                        type="application/x-shockwave-flash">
                    <param value="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf?volume_level=0" name="movie">
                    <param value="true" name="allowFullScreen">
                    <param value="transparent" name="wmode">
                    <param value="config={'playlist':[{'url':'<?php echo JUri::base() . $videoMp4; ?>'
            <?php echo ($params->get('muted')) ? ',"muted"= true' : ''; ?>
            <?php echo ($params->get('loop')) ? ',"loop"= true' : ''; ?>
            <?php echo ($params->get('loop')) ? ',"autoplay"= true' : ''; ?>}]}" name="flashVars">
                    <!--            <img title="No video playback capabilities, please download the video below" src="http://sandbox.thewikies.com/vfe-generator/images/big-buck-bunny_poster.jpg" alt="Big Buck Bunny">-->
                </object>
            </video>
        <?php endif; ?>

        <?php if ($params->get('bg_type') AND $background = $params->get('background')): ?>
            <img src="<?php echo JUri::base() . $background; ?>" alt="" class="bg-image"/>
        <?php endif; ?>

        <?php if ($params->get('show_bg_over', 1)): ?>
            <div class="bg-overlay"></div>
        <?php endif; ?>
        <div class="video-content">
            <div class="container">
                <?php if ($params->get('show_heading') AND ($heading = $params->get('heading', null))): ?>
                    <h2 class="large-title witTxt center">
                        <?php echo $heading; ?>
                    </h2>
                <?php endif; ?>
                <?php if ($params->get('show_introtext', 1) AND $introtext = $params->get('description')): ?>
                    <p class="witTxt large-text center"><?php echo $introtext; ?></p>
                <?php endif; ?>
                <ul class="larg-socials">
                    <?php foreach ($list as $i => $item) : ?>
                        <li>
                            <a href="<?php echo $item->statistic_percent; ?>">
                                <i class="<?php echo $item->statistic_title ?>"></i>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>