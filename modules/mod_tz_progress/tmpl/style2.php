<?php

/*------------------------------------------------------------------------

# MOD_TZ_NEW_PRO Extension

# ------------------------------------------------------------------------

# author    TuanNATemplaza

# copyright Copyright (C) 2013 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/
// no direct access

defined('_JEXEC') or die;
?>
<?php if ($list): ?>
    <?php if ($params->get('animate', '')): ?>
    <div class="fx" data-animate="<?php echo $params->get('animate'); ?>">
        <?php endif; ?>
        <ul class="levels-2">
            <?php foreach ($list as $i => $item): ?>
                <li>
                    <div class="level-out-2">
										<span class="chart" data-percent="<?php echo $item->value ?>">
											<span class="percent"></span>
										</span>
                    </div>
                    <span class="level-name-2"><?php echo $item->title; ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php if ($params->get('animate', '')): ?>
    </div>
<?php endif; ?>
    <script type="text/javascript">
        jQuery('.no-touch .levels-2').waypoint(function () {
            jQuery('.chart').easyPieChart({
                size: 140,
                scaleLength: 0,
                lineWidth: 3,
                barColor: '#888',
                trackColor: '#e4e4e4',
                animate: ({ duration: 2000, enabled: true }),
                onStep: function (from, to, percent) {
                    jQuery(this.el).find('.percent').text(Math.round(percent));
                }
            });
        }, {offset: '90%', triggerOnce: true});

        jQuery('.touch .chart').easyPieChart({
            size: 140,
            scaleLength: 0,
            lineWidth: 3,
            barColor: '#888',
            trackColor: '#e4e4e4',
            animate: ({ duration: 2000, enabled: true }),
            onStep: function (from, to, percent) {
                jQuery(this.el).find('.percent').text(Math.round(percent));
            }
        });
    </script>
<?php endif; ?>
