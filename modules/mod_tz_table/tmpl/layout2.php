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
?>
<?php if ($params->get('text_2')): ?>
    <h3 class="oe-non-space-top"><?php echo $params->get('text_2') ?></h3>
<?php endif; ?>

<?php if ($list): ?>
    <table class="table table-bordered oe-table oe-effects">
        <tbody>
        <?php foreach ($list as $i => $item): ?>
            <?php if ($i == 0 or $i % 2 == 0): ?>
                <tr>
            <?php endif; ?>
            <td class="text-center" width="5%">
                <i class="fa fa-check-square-o"></i>
            </td>
            <td><?php echo $item->title; ?></td>
            <?php if ($i % 2 != 0): ?>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

