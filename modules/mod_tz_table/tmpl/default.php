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
<div class="row oe-row oe-full-banner oe-banner-repeat" data-uk-scrollspy="{cls:'animate-started',delay:500}">
    <div class="hidden-xs hidden-sm col-xs-12 col-md-6 col-md-offset-6 oe-col-non-pd oe-full-banner oe-block-float oe-effects oe-frombottom"
         style="background-image:url(<?php echo $params->get('image_default') ?>);">
    </div>
    <div class="container oe-mtop oe-mbot-2x">
        <div class="row oe-row">
            <div class="col-xs-12 col-md-6">

                <?php echo $params->get('text_default'); ?>
                <?php if ($list): ?>
                    <table class="table table-bordered oe-table oe-effects oe-frombottom">
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
            </div>
        </div>
    </div>
</div>
