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

if ($list): ?>
    <div class="widget blog-cat-w fx" data-animate="fadeInRight">

        <div class="widget-content">
            <ul class="list list-ok alt">
                <?php $i = 0; ?>
                <?php $str = null; ?>
                <?php ob_start(); ?>
                <?php foreach ($list as $item): ?>

                    <?php
                    if (count($list) > 1 AND isset($list[$i + 1]->level))
                        $subLevel = (int)$list[$i + 1]->level - (int)$list[$i]->level;
                    else
                        $subLevel = 0;
                    ?>
                    <?php if ($subLevel == 0): ?>
                        <li class="level00">
                            <a href="<?php echo $item->link ?>"><?php echo $item->title; ?></a>
                                <?php if (isset($item->total)): ?>
                                    <span>[<?php echo $item->total ?>]</span>
                                <?php endif; ?>

                        </li>

                    <?php elseif ($subLevel > 0): ?>
                        <li class="level00 haschild">
                        <a href="<?php echo $item->link ?>"><?php echo $item->title; ?></a>
                            <?php if (isset($item->total)): ?>
                                <span>[<?php echo $item->total ?>]</span>
                            <?php endif; ?>

                        <ul class="sub-menu-category sub-menu-category-<?php echo $subLevel ?>">
                    <?php
                    elseif ($subLevel < 0): ?>
                        <li class="level00">
                            <a href="<?php echo $item->link ?>"><?php echo $item->title; ?> </a>
                                <?php if (isset($item->total)): ?>
                                    <span>[<?php echo $item->total ?>]</span>
                                <?php endif; ?>

                        </li>
                        <?php for ($k = 0; $k > $subLevel; $k--): ?>
                            </ul>
                            </li>
                        <?php endfor; ?>
                    <?php endif; ?>

                    <?php $i++; ?>
                <?php endforeach; ?>
                <?php $str = ob_get_contents() ?>
                <?php ob_end_clean(); ?>
                <?php echo $str; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>

<script type="text/javascript">
    var tz = jQuery.noConflict();
    tz('ul.category-menu > li.haschild').hover(function () {
        tz(this).find('ul.sub-menu-category').first().delay(200).slideToggle();
    });
    tz('ul.sub-menu-category > li.haschild').hover(function () {
        tz(this).find('ul.sub-menu-category').first().delay(200).slideToggle();
    });


</script>
