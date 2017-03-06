<?php
/*------------------------------------------------------------------------

# TZ Portfolio Extension

# ------------------------------------------------------------------------

# author    TemPlaza

# copyright Copyright (C) 2012 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/
$link = $params->get('tag-link');

?>
<div class="tags">
    <?php

    foreach ($list as $tag) {
        ?>
        <?php if ($link == 'yes') { ?>
            <a href="<?php echo $tag->taglink; ?>"><?php echo $tag->tagname; ?></a>

        <?php } else { ?>
            <span><?php echo $tag->tagname; ?></span>
        <?php }
    } ?>

</div>