<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_breadcrumbs
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');
$template = JFactory::getApplication()->getTemplate(true)->params;
$doc = JFactory::getDocument();

?>

<?php if ($template->get('type_breadcrumbs') == 1): ?>
    <?php $style_breadcrumbs = '.page-title  {
        background: url(' . JUri::root() . $template->get('image_breadcrumbs') . ') no-repeat scroll 50% 50% / cover #fff;  }';
    $doc->addStyleDeclaration($style_breadcrumbs);?>

    <h1 class="fx" data-animate="fadeInLeft"><?php echo $template->get('title_breadcrumbs'); ?></h1>
    <div class="breadcrumbs main-bg fx" data-animate="fadeInUp">
        <ul class="breadcrumb<?php echo $moduleclass_sfx; ?>">
            <?php
            if ($params->get('showHere', 1)) {
                echo '<li class="active">' . JText::_('MOD_BREADCRUMBS_HERE') . '&#160;</li>';
            } else {
                echo '<li class="active"><span class="divider icon-location"></span></li>';
            }

            // Get rid of duplicated entries on trail including home page when using multilanguage
            for ($i = 0; $i < $count; $i++) {
                if ($i == 1 && !empty($list[$i]->link) && !empty($list[$i - 1]->link) && $list[$i]->link == $list[$i - 1]->link) {
                    unset($list[$i]);
                }
            }
            // Find last and penultimate items in breadcrumbs list
            end($list);
            $last_item_key = key($list);
            prev($list);
            $penult_item_key = key($list);

            // Make a link if not the last item in the breadcrumbs
            $show_last = $params->get('showLast', 1);

            // Generate the trail
            foreach ($list as $key => $item) :
                if ($key != $last_item_key) {
                    // Render all but last item - along with separator
                    echo '<li>';
                    if (!empty($item->link)) {
                        echo '<a href="' . $item->link . '" class="pathway">' . $item->name . '</a>';
                    } else {
                        echo '<span>' . $item->name . '</span>';
                    }
                    if (($key != $penult_item_key) || $show_last) {
                        echo '<span class="divider">' . '</span>';
                    }

                    echo '</li>';
                } elseif ($show_last) {
                    // Render last item if reqd.
                    echo '<li class="active">';
                    echo '<span>' . $item->name . '</span>';
                    echo '</li>';
                }
            endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<?php if ($template->get('type_breadcrumbs') == 2): ?>
    <?php $style_breadcrumbs = '.page-title  {
        background: url(' . JUri::root() . $template->get('image_breadcrumbs') . ') no-repeat scroll 50% 50% / cover #fff;  }';
    $doc->addStyleDeclaration($style_breadcrumbs);?>
    <div class="row">
        <div class="cell-12">
            <i data-animate="fadeInUp" class="<?php echo $template->get('icon_breadcrumbs'); ?> main-bg Anim"></i>

            <h1 class="Anim" data-animate="fadeInRight"><?php echo $template->get('title_breadcrumbs'); ?></h1>
        </div>
        <div class="cell-12">
            <div data-animate="fadeInRight" class="breadcrumbs Anim pull-right margin-right-45">
                <ul class="breadcrumb<?php echo $moduleclass_sfx; ?>">
                    <?php
                    if ($params->get('showHere', 1)) {
                        echo '<li class="active">' . JText::_('MOD_BREADCRUMBS_HERE') . '&#160;</li>';
                    } else {
                        echo '<li class="active"><span class="divider icon-location"></span></li>';
                    }

                    // Get rid of duplicated entries on trail including home page when using multilanguage
                    for ($i = 0; $i < $count; $i++) {
                        if ($i == 1 && !empty($list[$i]->link) && !empty($list[$i - 1]->link) && $list[$i]->link == $list[$i - 1]->link) {
                            unset($list[$i]);
                        }
                    }
                    // Find last and penultimate items in breadcrumbs list
                    end($list);
                    $last_item_key = key($list);
                    prev($list);
                    $penult_item_key = key($list);

                    // Make a link if not the last item in the breadcrumbs
                    $show_last = $params->get('showLast', 1);

                    // Generate the trail
                    foreach ($list as $key => $item) :
                        if ($key != $last_item_key) {
                            // Render all but last item - along with separator
                            echo '<li>';
                            if (!empty($item->link)) {
                                echo '<a href="' . $item->link . '" class="pathway">' . $item->name . '</a>';
                            } else {
                                echo '<span>' . $item->name . '</span>';
                            }
                            if (($key != $penult_item_key) || $show_last) {
                                echo '<span class="divider">' . '</span>';
                            }

                            echo '</li>';
                        } elseif ($show_last) {
                            // Render last item if reqd.
                            echo '<li class="active">';
                            echo '<span>' . $item->name . '</span>';
                            echo '</li>';
                        }
                    endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if ($template->get('type_breadcrumbs') == 3): ?>
    <?php $style_breadcrumbs = '.page-title  {
        background: url(' . JUri::root() . $template->get('image_breadcrumbs') . ') no-repeat scroll 50% 50% / cover rgba(0, 0, 0, 0);  }';
    $doc->addStyleDeclaration($style_breadcrumbs);?>
    <div class="row">
        <div class="cell-12">
            <i data-animate="fadeInUp" class="<?php echo $template->get('icon_breadcrumbs'); ?> main-bg Anim"></i>

            <h1 class="Anim" data-animate="fadeInRight"><?php echo $template->get('title_breadcrumbs'); ?></h1>
        </div>
        <div class="cell-12">
            <div data-animate="fadeInRight" class="breadcrumbs Anim pull-right margin-right-45">
                <ul class="breadcrumb<?php echo $moduleclass_sfx; ?>">
                    <?php
                    if ($params->get('showHere', 1)) {
                        echo '<li class="active">' . JText::_('MOD_BREADCRUMBS_HERE') . '&#160;</li>';
                    } else {
                        echo '<li class="active"><span class="divider icon-location"></span></li>';
                    }

                    // Get rid of duplicated entries on trail including home page when using multilanguage
                    for ($i = 0; $i < $count; $i++) {
                        if ($i == 1 && !empty($list[$i]->link) && !empty($list[$i - 1]->link) && $list[$i]->link == $list[$i - 1]->link) {
                            unset($list[$i]);
                        }
                    }
                    // Find last and penultimate items in breadcrumbs list
                    end($list);
                    $last_item_key = key($list);
                    prev($list);
                    $penult_item_key = key($list);

                    // Make a link if not the last item in the breadcrumbs
                    $show_last = $params->get('showLast', 1);

                    // Generate the trail
                    foreach ($list as $key => $item) :
                        if ($key != $last_item_key) {
                            // Render all but last item - along with separator
                            echo '<li>';
                            if (!empty($item->link)) {
                                echo '<a href="' . $item->link . '" class="pathway">' . $item->name . '</a>';
                            } else {
                                echo '<span>' . $item->name . '</span>';
                            }
                            if (($key != $penult_item_key) || $show_last) {
                                echo '<span class="divider">' . '</span>';
                            }

                            echo '</li>';
                        } elseif ($show_last) {
                            // Render last item if reqd.
                            echo '<li class="active">';
                            echo '<span>' . $item->name . '</span>';
                            echo '</li>';
                        }
                    endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if ($template->get('type_breadcrumbs') == 4): ?>
    <?php $style_breadcrumbs = '.page-title  {
        background: url(' . JUri::root() . $template->get('image_breadcrumbs') . ') no-repeat scroll 50% 50% / cover rgba(0, 0, 0, 0);  }';
    $doc->addStyleDeclaration($style_breadcrumbs);?>
    <div class="row">
        <div class="cell-12">
            <h1 class="skew-25 dark-Gr"><span class="skew25"><?php echo $template->get('title_breadcrumbs'); ?></span>
            </h1>

            <div class="skew-25 title-4-desc"><span
                    class="skew25"><?php echo $template->get('desc_breadcrumbs'); ?></span></div>
        </div>
        <div class="cell-12">
            <div class="breadcrumbs skew-25 Anim pull-right margin-right-45">
                <ul class="breadcrumb<?php echo $moduleclass_sfx; ?>">
                    <?php
                    if ($params->get('showHere', 1)) {
                        echo '<li class="active skew25">' . JText::_('MOD_BREADCRUMBS_HERE') . '&#160;</li>';
                    } else {
                        echo '<li class="active skew25"><span class="divider icon-location"></span></li>';
                    }

                    // Get rid of duplicated entries on trail including home page when using multilanguage
                    for ($i = 0; $i < $count; $i++) {
                        if ($i == 1 && !empty($list[$i]->link) && !empty($list[$i - 1]->link) && $list[$i]->link == $list[$i - 1]->link) {
                            unset($list[$i]);
                        }
                    }
                    // Find last and penultimate items in breadcrumbs list
                    end($list);
                    $last_item_key = key($list);
                    prev($list);
                    $penult_item_key = key($list);

                    // Make a link if not the last item in the breadcrumbs
                    $show_last = $params->get('showLast', 1);

                    // Generate the trail
                    foreach ($list as $key => $item) :
                        if ($key != $last_item_key) {
                            // Render all but last item - along with separator
                            echo '<li class="skew25">';
                            if (!empty($item->link)) {
                                echo '<a href="' . $item->link . '" class="pathway">' . $item->name . '</a>';
                            } else {
                                echo '<span>' . $item->name . '</span>';
                            }
                            if (($key != $penult_item_key) || $show_last) {
                                echo '<span class="divider">' . '</span>';
                            }

                            echo '</li>';
                        } elseif ($show_last) {
                            // Render last item if reqd.
                            echo '<li class="active skew25">';
                            echo '<span>' . $item->name . '</span>';
                            echo '</li>';
                        }
                    endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>
