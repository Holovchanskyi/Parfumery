<?php
/*------------------------------------------------------------------------

# TZ Portfolio Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2012-2013 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

//no direct access
defined('_JEXEC') or die();
$doc = JFactory::getDocument();
$bg_ourPlan = '.our-plan {
    background: url("'.JUri::root().$params->get('bg').'") no-repeat fixed 0 0 / cover #fff;
    position: relative;
}
#tz-position-2-wrapper.our-plan {
    padding: 0 !important;
}
.our-plan:before{
    background-color: rgba(232, 82, 47, 0.7);
    content: "";
    display: inline-block;
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
}
.plan-year{
     background: url("'.JUri::root().$params->get('bg1').'") no-repeat scroll 0 100% transparent;
}';
$doc->addStyleDeclaration($bg_ourPlan);
$content_right = null;
$content_left = null;
?>
<?php foreach ($list as $i => $item): ?>
    <?php if ($i % 2 == 0): ?>
        <?php $content_right .= '<div class="block fx" data-animate="fadeInLeft">
								<h3>' . $item->title . '</h3>' . $item->content . '
								<div class="plan-year"><span>' . $item->icon . '</span></div>
							</div>'; ?>
    <?php else: ?>
        <?php $content_left .= '<div class="block fx" data-animate="fadeInLeft">
								<h3>' . $item->title . '</h3>' . $item->content . '
								<div class="plan-year"><span>' . $item->icon . '</span></div>
							</div>'; ?>
    <?php endif; ?>
<?php endforeach; ?>


<div class="cell-5 plan-block lft-plan">
    <?php echo $content_left; ?>
</div>

<div class="cell-2 plan-title">
    <?php echo $params->get('description') ?>
</div>

<div class="cell-5 plan-block rit-plan">
    <?php echo $content_right; ?>
</div>
<script type="text/javascript">
    jQuery(window).ready(function(){
        jQuery('.plan-title').css('height',jQuery('.our-plan').height());
    });
</script>