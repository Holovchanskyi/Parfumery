<?php
/*------------------------------------------------------------------------

# TZ Portfolio Extension

# ------------------------------------------------------------------------

# author    TuanNATemplaza

# copyright Copyright (C) 2012-2013 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

//no direct access
defined('_JEXEC') or die();
$doc = JFactory::getDocument();
$doc->addScript(JUri::root() . 'modules/mod_tz_tab/js/tab.js');
?>
<?php if ($list): ?>
    <div id="tabs<?php echo $module->id; ?>" class="tabs">
        <ul>
            <?php foreach ($list as $i => $title): ?>
                <?php $ac = '';
                if ($i == 0) $ac = 'active'; ?>
                <li class="skew-25 <?php echo $ac ?>">
                    <a href="#" class="skew25">
                        <i class="<?php echo $title->icon ?>"></i> <?php echo $title->title; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="tabs-pane">
            <?php foreach ($list as $j => $item): ?>
                <?php $ac = '';
                if ($j == 0) $ac = 'active'; ?>
                <div class="tab-panel <?php echo $ac; ?>">
                    <?php echo $item->content; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function () {

            <?php if($params->get('type_tab')== 2):?>
            jQuery('#tabs<?php echo $module->id;?>').tabs();
            <?php else:?>
            jQuery('#tabs<?php echo $module->id;?>').tabs({direction: 'vertical'});
            <?php endif;?>
        });
    </script>
<?php endif; ?>