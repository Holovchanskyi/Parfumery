<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
$params = $this->params;
//var_dump($this->params->get('page_heading'));
?>
<div class="fx" data-animate="fadeInRight">

    <h3 class="block-head"><?php echo $params->get('page_heading') ?></h3>

    <div class="registration<?php echo $this->pageclass_sfx ?> contact-form">
        <?php if ($this->params->get('show_page_heading')) : ?>
            <div class="page-header">
                <h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
            </div>
        <?php endif; ?>

        <form id="member-registration"
              action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post"
              class="form-validate  hire_form" enctype="multipart/form-data">
            <?php foreach ($this->form->getFieldsets() as $fieldset): // Iterate through the form fieldsets and display each one.?>
                <?php $fields = $this->form->getFieldset($fieldset->name); ?>
                <?php if (count($fields)): ?>
                    <?php foreach ($fields as $field) : // Iterate through the fields in the set and display them.?>
                        <?php if ($field->hidden): // If the field is hidden, just display the input.?>
                            <?php echo $field->input; ?>
                        <?php else: ?>
                            <div class="form-input">
                                <div class="control-label">
                                    <?php echo $field->label; ?>

                                    <?php echo $field->input; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>

            <div class="controls">
                <button type="submit"
                        class="btn btn-large main-bg validate"><?php echo JText::_('JREGISTER'); ?></button>
                <a class="btn btn-large main-bg" href="<?php echo JRoute::_(''); ?>"
                   title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
                <input type="hidden" name="option" value="com_users"/>
                <input type="hidden" name="task" value="registration.register"/>
            </div>

            <?php echo JHtml::_('form.token'); ?>
        </form>
    </div>
</div>