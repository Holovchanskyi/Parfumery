<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');

if (isset($this->error)) : ?>
    <div class="contact-error">
        <?php echo $this->error; ?>
    </div>
<?php endif; ?>

<div class="contact-form">
    <form id="contact-form" action="<?php echo JRoute::_('index.php'); ?>" method="post"
          class="form-validate form-signin cform">
        <div class="form-input">
            <?php echo $this->form->getLabel('contact_name'); ?>
            <?php echo $this->form->getInput('contact_name'); ?>
        </div>
        <div class="form-input">
            <?php echo $this->form->getLabel('contact_email'); ?>
            <?php echo $this->form->getInput('contact_email'); ?>
        </div>
        <div class="form-input">
            <?php echo $this->form->getLabel('contact_subject'); ?>
            <?php echo $this->form->getInput('contact_subject'); ?>
        </div>
        <div class="form-input">
            <?php echo $this->form->getLabel('contact_message'); ?>
            <?php echo $this->form->getInput('contact_message'); ?>
        </div>
        <?php if ($this->params->get('show_email_copy')) : ?>
            <div class="form-input">
                <?php echo $this->form->getLabel('contact_email_copy'); ?>
                <?php echo $this->form->getInput('contact_email_copy'); ?>
            </div>
        <?php endif; ?>
        <?php //Dynamically load any additional fields from plugins. ?>
<!--        --><?php //$field_contact = $this->form->getFieldsets(); ?>
<!--        --><?php //if (isset($field_contact) && !empty($field_contact) && count($field_contact) > 0): ?>
<!--            --><?php //foreach ($this->form->getFieldsets() as $fieldset) : ?>
<!--                --><?php //if ($fieldset->name != 'contact') : ?>
<!--                    --><?php //$fields = $this->form->getFieldset($fieldset->name); ?>
<!--                    --><?php //foreach ($fields as $field) : ?>
<!--                        <div class="control-group">-->
<!--                            --><?php //if ($field->hidden) : ?>
<!--                                <div class="controls">-->
<!--                                    --><?php //echo $field->input; ?>
<!--                                </div>-->
<!--                            --><?php //else: ?>
<!--                                <div class="control-label">-->
<!--                                    --><?php //echo $field->label; ?>
<!--                                    --><?php //if (!$field->required && $field->type != "Spacer") : ?>
<!--                                        <span class="optional">--><?php //echo JText::_('COM_CONTACT_OPTIONAL'); ?><!--</span>-->
<!--                                    --><?php //endif; ?>
<!--                                </div>-->
<!--                                <div class="controls">--><?php //echo $field->input; ?><!--</div>-->
<!--                            --><?php //endif; ?>
<!--                        </div>-->
<!--                    --><?php //endforeach; ?>
<!--                --><?php //endif; ?>
<!--            --><?php //endforeach; ?>
<!--        --><?php //endif; ?>
        <div class="form-input">
            <button class="btn btn-large main-bg margin-bottom-20" type="submit">
                <?php echo JText::_('COM_CONTACT_CONTACT_SEND'); ?>
            </button>
            <input type="hidden" name="option" value="com_contact"/>
            <input type="hidden" name="task" value="contact.submit"/>
            <input type="hidden" name="return" value="<?php echo $this->return_page; ?>"/>
            <input type="hidden" name="id" value="<?php echo $this->contact->slug; ?>"/>
            <?php echo JHtml::_('form.token'); ?>
        </div>
    </form>
</div>
