<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_weblinks
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$doc = JFactory::getDocument();
$doc->addScript(JUri::root() . 'modules/mod_tz_clients/js/slick.min.js');
?>
<div class="weblinks<?php echo $moduleclass_sfx; ?> clients">
    <?php foreach ($list as $item) : ?>
        <div>
            <?php $link = $item->link; ?>
            <a class="white-bg" href="<?php echo $link ?>">
                <img src="<?php echo $item->image; ?>" alt="<?php echo $item->title; ?>">
            </a>
        </div>
    <?php endforeach; ?>
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
    if ($params->get('arrows') == 1) {
        $arrows = 'true';
    } else {
        $arrows = 'false';
    }
    ?>
    <script type="text/javascript">
        jQuery('.clients').slick({
            arrows:<?php echo $arrows?>,
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
    </script>
</div>
