<?php
/*------------------------------------------------------------------------

# TZ Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2012 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

defined('_JEXEC') or die;

?>
<?php if ($params->get('show_infor') == 1): ?>
    <dl class="contact-address dl-horizontal">
        <?php if ($params->get('show_street_address', 1) OR $params->get('show_suburb', 1)
            OR $params->get('show_state', 1) OR $params->get('show_postcode', 1)
            OR $params->get('show_country', 1)
        ):?>
            <dt>
        <span class="<?php echo $params->get('marker_class'); ?>">
            <?php echo $params->get('marker_address'); ?>
        </span>
            </dt>
            <?php if (!empty($contact->address)): ?>
                <dd>
        <span class="contact-street">
            <?php echo $contact->address . '<br/>'; ?>
        </span>
                </dd>
            <?php endif; ?>
            <?php if (!empty($contact->suburb)): ?>
                <dd>
        <span class="contact-suburb">
            <?php echo $contact->suburb . '<br/>'; ?>
        </span>
                </dd>
            <?php endif; ?>
            <?php if (!empty($contact->state)): ?>
                <dd>
        <span class="contact-state">
            <?php echo $contact->state . '<br/>'; ?>
        </span>
                </dd>
            <?php endif; ?>
            <?php if (!empty($contact->postcode)): ?>
                <dd>
        <span class="contact-postcode">
            <?php echo $contact->postcode . '<br/>'; ?>
        </span>
                </dd>
            <?php endif; ?>
            <?php if (!empty($contact->country)): ?>
                <dd>
        <span class="contact-country">
            <?php echo $contact->country . '<br/>'; ?>
        </span>
                </dd>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($params->get('show_email', 1)): ?>
            <?php if (!empty($contact->email_to)): ?>
                <dt>
        <span class="<?php echo $params->get('marker_class'); ?>">
            <?php echo nl2br($params->get('marker_email')); ?>
        </span>
                </dt>
                <dd>
        <span class="contact-emailto">
            <?php echo $contact->email_to; ?>
        </span>
                </dd>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($params->get('show_telephone', 1)): ?>
            <?php if (!empty($contact->telephone)): ?>
                <dt>
        <span class="<?php echo $params->get('marker_class'); ?>">
            <?php echo $params->get('marker_telephone'); ?>
        </span>
                </dt>
                <dd>
        <span class="contact-telephone">
            <?php echo nl2br($contact->telephone); ?>
        </span>
                </dd>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($params->get('show_fax', 1)): ?>
            <dt>
        <span class="<?php echo $params->get('marker_class'); ?>">
            <?php echo $params->get('marker_fax'); ?>
        </span>
            </dt>
            <dd>
        <span class="contact-fax">
        <?php echo nl2br($contact->fax); ?>
        </span>
            </dd>
        <?php endif; ?>

        <?php if ($params->get('show_mobile', 1)): ?>
            <?php if (!empty($contact->mobile)): ?>
                <dt>
        <span class="<?php echo $params->get('marker_class'); ?>">
            <?php echo $params->get('marker_mobile'); ?>
        </span>
                </dt>
                <dd>
        <span class="contact-mobile">
            <?php echo nl2br($contact->mobile); ?>
        </span>
                </dd>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($params->get('show_webpage', 1)): ?>
            <?php if (!empty($contact->webpage)): ?>
                <dt>
                    <span
                        class="<?php echo $params->get('marker_class'); ?>"><?php echo $params->get('marker_website'); ?></span>
                </dt>
                <dd>
        <span class="contact-webpage">
            <a href="<?php echo $contact->webpage; ?>" target="_blank">
                <?php echo $contact->webpage; ?></a>
        </span>
                </dd>
            <?php endif; ?>
        <?php endif; ?>
    </dl>
<?php endif; ?>