<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * marker_class: Class based on the selection of text, none, or icons
 * jicon-text, jicon-none, jicon-icon
 */
?>
<div class="fx cell-12 " data-animate="fadeInRight" itemscope itemtype="http://schema.org/PostalAddress">
    <?php if ($this->contact->suburb && $this->params->get('show_suburb')) : ?>
        <h4 class="main-color bold" itemprop="addressLocality" style="font-size: 24px;">
            <?php echo $this->contact->suburb; ?>
        </h4>
    <?php endif; ?>
    <?php if ($this->contact->address && $this->params->get('show_street_address')) : ?>
        <h5 itemprop="streetAddress">
            <?php echo JText::_('TPL_ADDRESS_CONTACT'); ?>
        </h5>
        <p>
            <?php echo $this->contact->address; ?>
        </p>
    <?php endif; ?>
    <?php if ($this->contact->email_to && $this->params->get('show_email')) : ?>
        <h5><?php echo JText::_('TPL_EMAIL_CONTACT') ?></h5>

        <span class="<?php echo $this->params->get('marker_class'); ?>" itemprop="email">
			<?php echo nl2br($this->params->get('marker_email')); ?>
		</span>

        <p>
            <?php echo $this->contact->email_to; ?>
        </p>

    <?php endif; ?>
    <?php if ($this->contact->state && $this->params->get('show_state')) : ?>

        <p itemprop="addressRegion">
            <?php echo $this->contact->state; ?>
        </p>

    <?php endif; ?>
    <?php if ($this->contact->postcode && $this->params->get('show_postcode')) : ?>
        <h5><?php echo JText::_('TPL_POST_CODE_CONTACT') ?></h5>
        <p itemprop="postalCode">
            <?php echo $this->contact->postcode; ?>
        </p>

    <?php endif; ?>
    <?php if ($this->contact->country && $this->params->get('show_country')) : ?>
        <h5><?php echo JText::_('TPL_COUNTRY_CONTACT') ?></h5>
        <p itemprop="addressCountry">
            <?php echo $this->contact->country; ?>
        </p>

    <?php endif; ?>

    <?php if ($this->contact->telephone && $this->params->get('show_telephone')) : ?>

        <span class="<?php echo $this->params->get('marker_class'); ?>">
			<?php echo $this->params->get('marker_telephone'); ?>
		</span>
        <h5><?php echo JText::_('TPL_PHONE_CONTACT') ?></h5>
        <p itemprop="telephone">
            <?php echo nl2br($this->contact->telephone); ?>
        </p>

    <?php endif; ?>
    <?php if ($this->contact->fax && $this->params->get('show_fax')) : ?>

        <span class="<?php echo $this->params->get('marker_class'); ?>">
			<?php echo $this->params->get('marker_fax'); ?>
		</span>
        <h5><?php echo JText::_('TPL_FAX_CONTACT') ?></h5>
        <p itemprop="faxNumber">
            <?php echo nl2br($this->contact->fax); ?>
        </p>

    <?php endif; ?>
    <?php if ($this->contact->mobile && $this->params->get('show_mobile')) : ?>
        <span class="<?php echo $this->params->get('marker_class'); ?>">
			<?php echo $this->params->get('marker_mobile'); ?>
		</span>
        <h5><?php echo JText::_('TPL_MOBILE_CONTACT') ?></h5>
        <p itemprop="telephone">
            <?php echo nl2br($this->contact->mobile); ?>
        </p>

    <?php endif; ?>
    <?php if ($this->contact->webpage && $this->params->get('show_webpage')) : ?>

        <span class="<?php echo $this->params->get('marker_class'); ?>">
		</span>
        <h5><?php echo JText::_('TPL_WEB_CONTACT') ?></h5>
        <p>
            <a href="<?php echo $this->contact->webpage; ?>" target="_blank" itemprop="url">
                <?php echo JStringPunycode::urlToUTF8($this->contact->webpage); ?></a>
        </p>

    <?php endif; ?>
    
</div>

