<?php
/*------------------------------------------------------------------------

# ------------------------------------------------------------------------

# author    TuanNATemPlaza

# copyright Copyright (C) 2012 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

defined('_JEXEC') or die();
?>

<div class="oe-box-tab oe-box-testimonials oe-box-testimonials-2">
    <ul class="nav nav-tabs oe-tours oe-tabs-testimonials" role="tablist">
        <?php foreach ($list as $i => $item): ?>
            <li class="<?php if ($i == 0): echo 'active'; endif; ?>">
                <a href="#te<?php echo $i;
                echo $module->id; ?>" role="tab" data-toggle="tab">
                    <i class="fa oe-icon <?php echo $item->testimonial_icon; ?>"></i>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="tab-content oe-tours-content oe-testimonials-content">
        <?php foreach ($list as $i => $item): ?>
            <div class="tab-pane <?php if ($i == 0): echo 'active'; endif; ?>" id="te<?php echo $i;
            echo $module->id; ?>">
                <figure class="oe-image-item">
                    <img src="<?php echo $item->testimonial_image ?>" alt=""/>
                </figure>
                <p class="oe-mtop">
                    <?php echo $item->testimonial_quotations; ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
