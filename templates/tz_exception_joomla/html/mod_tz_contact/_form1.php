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
JFactory::getLanguage()->load('com_contact');

?>
<?php if ($params->get('show_email_form', 1)): ?>
    <form class="form-signin cform form-validate form-horizontal" method="post" action="<?php echo JRoute::_('index.php'); ?>"
          id="contact-form" autocomplete="on">
        <fieldset>
            <div class="form-input">

                <label
                    title="<?php echo JText::_('COM_CONTACT_CONTACT_EMAIL_NAME_LABEL'); ?>::<?php echo JText::_('COM_CONTACT_CONTACT_EMAIL_NAME_DESC'); ?>"
                    class="hasTip required"
                    for="jform_contact_name" id="jform_contact_name-lbl">
                    <?php echo JText::_('COM_CONTACT_CONTACT_EMAIL_NAME_LABEL'); ?><span class="red">&nbsp;*</span>
                </label>

                <input type="text" aria-required="true" required="required" size="30" class="required"
                       value="" id="jform_contact_name" name="jform[contact_name]">
            </div>
            <div class="form-input">

                <label
                    title="<?php echo JText::_('COM_CONTACT_EMAIL_LABEL'); ?>::<?php echo JText::_('COM_CONTACT_EMAIL_DESC'); ?>"
                    class="hasTip required" for="jform_contact_email" id="jform_contact_email-lbl">
                    <?php echo JText::_('COM_CONTACT_EMAIL_LABEL'); ?><span class="red">&nbsp;*</span>
                </label>

                <input type="email" aria-required="true" required="required" size="30" value=""
                       id="jform_contact_email" class="validate-email required" name="jform[contact_email]"/>

            </div>
            <?php if ($params->get('show_subject', 1)): ?>
                <div class="form-input">

                    <label
                        title="<?php echo JText::_('COM_CONTACT_CONTACT_MESSAGE_SUBJECT_LABEL'); ?>::<?php echo JText::_('COM_CONTACT_CONTACT_MESSAGE_SUBJECT_DESC'); ?>"
                        class="hasTip required" for="jform_contact_emailmsg" id="jform_contact_emailmsg-lbl">
                        <?php echo JText::_('COM_CONTACT_CONTACT_MESSAGE_SUBJECT_LABEL'); ?><span
                            class="red">&nbsp;*</span>

                        <input type="text" aria-required="true"
                               required="required"
                               size="60"
                               class="required"
                               value=""
                               id="jform_contact_emailmsg"
                               name="jform[contact_subject]"/>

                </div>
            <?php endif; ?>
            <div class="form-input">

                <label
                    title="<?php echo JText::_('COM_CONTACT_CONTACT_ENTER_MESSAGE_LABEL'); ?>::<?php echo JText::_('COM_CONTACT_CONTACT_ENTER_MESSAGE_DESC'); ?>"
                    class="hasTip required"
                    for="jform_contact_message"
                    id="jform_contact_message-lbl">
                    <?php echo JText::_('COM_CONTACT_CONTACT_ENTER_MESSAGE_LABEL'); ?>
                    <span class="red">&nbsp;*</span>
                </label>

                <textarea aria-required="true"
                          required="required"
                          class="required"
                          rows="10"
                          cols="50"
                          id="jform_contact_message"
                          name="jform[contact_message]">
                </textarea>

            </div>
            <?php if ($params->get('show_email_copy', 1)): ?>
                <div class="form-input">
                    <label
                        title="<?php echo JText::_('COM_CONTACT_CONTACT_EMAIL_A_COPY_LABEL'); ?>::<?php echo JText::_('COM_CONTACT_CONTACT_EMAIL_A_COPY_DESC'); ?>"
                        class="hasTip" for="jform_contact_email_copy" id="jform_contact_email_copy-lbl">
                        <?php echo JText::_('COM_CONTACT_CONTACT_EMAIL_A_COPY_LABEL'); ?></label>

                    <input type="checkbox" value="1" id="jform_contact_email_copy" name="jform[contact_email_copy]">
                </div>
            <?php endif; ?>

            <?php if ($params->get('show_captcha', 1)): ?>
                <?php   JPluginHelper::importPlugin('captcha');
                $dispatcher = JDispatcher::getInstance();
                $dispatcher->trigger('onInit', 'dynamic_recaptcha_1');?>
                <div id="dynamic_recaptcha_1"></div>
            <?php endif; ?>
            <div class="form-input">
                <button type="button" class="btn btn-large main-bg validate" id="tz-contact-send">
                    <?php echo JText::_('COM_CONTACT_CONTACT_SEND'); ?>
                </button>
                &nbsp;&nbsp;
                <button type="button" class="btn btn-large" id="tz-contact-reset">
                    <?php echo JText::_('MOD_TZ_CONTACT_BUTTON_RESET_LABEL'); ?>
                </button>
                <div class="contact_loading">
                    <img src="<?php echo JUri::root() . $params->get('loading_contact'); ?>" alt=""/>
                </div>
            </div>
            <div class="form-actions">
                <input type="hidden" value="com_contact" name="option">
                <input type="hidden" value="contact.submit" name="task">
                <input type="hidden" value="" name="return">
                <input type="hidden" value="<?php echo $contact->id . ':' . $contact->alias; ?>" name="id">
                <?php echo JHtml::_('form.token'); ?>
            </div>
        </fieldset>
    </form>
<?php endif; ?>