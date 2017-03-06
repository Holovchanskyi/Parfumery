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
$doc->addScript('modules/mod_tz_twitterwidget/js/slick.min.js');
?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('.twitter-carousel').slick({
            dots: false,
            infinite: true,
            arrows: false,
            speed: 300,
            autoplay: true,
            slidesToShow: 1,
            touchMove: true,
            vertical: true,
            slidesToScroll: 1
        });
    });

</script>

<div id="wds-container" class="tweet container text-center">

    <span class="icon-middle main-color skew-25"><i class="fa fa-twitter skew25"></i></span>

    <div id="wds">
        <?php if ($params->get('header', 1)) : ?>
            <div id="wds-header">
                <?php if ($params->get('twitter_icon', 1)) : ?>
                    <div id="wds-twitter-icon"><a href="http://twitter.com" target="_blank">twitter</a></div>
                <?php endif; ?>
                <?php if ($params->get('type', 1)) : ?>
                    <a href="https://twitter.com/<?php echo $data->tweets[0]->screenName; ?>" target="_blank">
                        <img src="<?php echo $data->tweets[0]->profileImage; ?>" class="wds-avatar"/>
                        <span class="wds-display-name"><?php echo $data->tweets[0]->displayName; ?></span>
                        <span class='wds-screen-name'> @<?php echo $data->tweets[0]->screenName; ?></span>
                    </a>
                    <div style="clear: both;"></div>
                <?php else: ?>
                    <?php if ($params->get('link_title', 1)) : ?>
                        <a href="https://twitter.com/search/<?php echo $params->get('query', ''); ?>"
                           target="_blank"><?php echo $params->get('title', '') ?></a>
                    <?php else: ?>
                        <?php echo $params->get('title', ''); ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div id="wds-tweets" class="twitter-carousel twitter-style2">
            <?php foreach ($data->tweets as $key => $tweet): ?>
            <div class="wds-tweet-container <?php echo end(array_keys($data->tweets)) == $key ? ' wds-last' : ''; ?>">
                <?php if ($params->get('avatars', 1)): ?>
                <div>
                    <a href="https://twitter.com/intent/user?screen_name=<?php echo $tweet->screenName; ?>"
                       target="_blank">
                        <img src="<?php echo $tweet->profileImage; ?>" class="wds-avatar" style="width: 35px;"/>
                    </a>
                </div>
                <div class="wds-tweet" style="padding-left: 40px;">
                    <?php else: ?>
                    <div class="wds-tweet">
                        <?php endif; ?>
                        <?php if ($params->get('display_name', 1)): ?>
                            <a href="https://twitter.com/intent/user?screen_name=<?php echo $tweet->screenName; ?>"
                               target="_blank"><?php echo $tweet->screenName; ?></a>
                        <?php endif; ?>
                        <?php echo $tweet->text; ?>
                    </div>
                    <div class="wds-tweet-data">
                        <?php if ($params->get('timestamps', 1)): ?>
                            <a href="https://twitter.com/<?php echo $tweet->screenName; ?>/statuses/<?php echo $tweet->id; ?>"
                               target="_blank"><?php echo $tweet->time; ?></a>
                            <?php if ($params->get('reply', 1) || $params->get('retweet', 1) || $params->get('favorite', 1)): ?>
                                &bull;
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ($params->get('reply', 1)): ?>
                            <a href="https://twitter.com/intent/tweet?in_reply_to=<?php echo $tweet->id; ?>"
                               target="_blank">reply</a>
                            <?php if ($params->get('retweet', 1) || $params->get('favorite', 1)): ?>
                                &bull;
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ($params->get('retweet', 1)): ?>
                            <a href="https://twitter.com/intent/retweet?tweet_id=<?php echo $tweet->id; ?>"
                               target="_blank">retweet</a>
                            <?php if ($params->get('favorite', 1)): ?>
                                &bull;
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ($params->get('favorite', 1)): ?>
                            <a href="https://twitter.com/intent/favorite?tweet_id=<?php echo $tweet->id; ?>"
                               target="_blank">favorite</a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php if ($params->get('show_link', 1)) : ?>
            <div class="wds-copyright">
                <a href="http://www.webdesignservices.net" title="web design services" target="_blank">web design
                    services</a>
            </div>
        <?php endif; ?>
    </div>

