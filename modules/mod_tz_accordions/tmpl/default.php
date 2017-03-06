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
    <ul id="accordion<?php echo $module->id;?>" class="accordion">
        <?php foreach ($list as $i => $item): ?>
            <li>
                <h3>
                    <a href="#">
                        <span>
                            <i class="<?php echo $item->icon ?>"></i>
                            <?php echo $item->title ?>
                        </span>
                    </a>
                </h3>

                <div class="accordion-panel active">
                    <?php echo $item->content; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#accordion<?php echo $module->id;?>').accordion();
        });
    </script>
<?php endif; ?>