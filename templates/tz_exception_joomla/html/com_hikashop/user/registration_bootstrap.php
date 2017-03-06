<?php
/**
 * @package    HikaShop for Joomla!
 * @version    2.3.3
 * @author    hikashop.com
 * @copyright    (C) 2010-2014 HIKARI SOFTWARE. All rights reserved.
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?>
<?php
if ($this->display_method == 1) {
    $this->simplified_registration = explode(',', $this->simplified_registration);

    if (in_array('2', $this->simplified_registration)) {
        $registration = 2;
    }
    if (in_array('0', $this->simplified_registration)) {
        $registration = 0;
    }
    if (in_array('1', $this->simplified_registration)) {
        $registration = 1;
    }
    if (in_array('3', $this->simplified_registration)) {
        $registration = 3;
    }
    $this->simplified_registration = $registration;
}

if (!$this->simplified_registration) {
    ?>
    <div class=" hikashop_registration_name_line form-input" id="hikashop_registration_name_line">

        <label id="namemsg" for="register_name" class="required"
               title=""><?php echo JText::_('HIKA_USER_NAME'); ?></label>
        <input type="text" name="data[register][name]" id="register_name"
               value="<?php echo $this->escape($this->mainUser->get('name')); ?>" class="required" size="30"
               maxlength="50" <?php if (!empty($this->registration_page)) echo ' aria-required="true" required="required"'; ?>>

    </div>
    <div class=" hikashop_registration_username_line form-input" id="hikashop_registration_username_line">
        <label id="usernamemsg" for="register_username" class="required"
               title=""><?php echo JText::_('HIKA_USERNAME'); ?></label>
        <input type="text" name="data[register][username]" id="register_username"
               value="<?php echo $this->escape($this->mainUser->get('username')); ?>"
               class="required validate-username" maxlength="25"
               size="30" <?php if (!empty($this->registration_page)) echo ' aria-required="true" required="required"'; ?>>
    </div>
<?php } ?>
<div class=" hikashop_registration_email_line form-input">
    <label id="emailmsg" for="register_email" class="required"
           title=""><?php echo JText::_('HIKA_EMAIL'); ?></label>
    <input type="text" name="data[register][email]" id="register_email"
           value="<?php echo $this->escape($this->mainUser->get('email')); ?>" class="required validate-email"
           maxlength="100"
           size="30"<?php if (!empty($this->registration_page)) echo ' aria-required="true" required="required"'; ?>>
</div>
<?php if ($this->config->get('show_email_confirmation_field', 0)) { ?>
    <div class=" hikashop_registration_email_confirm_line form-input">

        <label id="email_confirm_msg" for="register_email_confirm" class="required"
               title=""><?php echo JText::_('HIKA_EMAIL_CONFIRM'); ?></label>

        <input type="text" name="data[register][email_confirm]" id="register_email_confirm"
               value="<?php echo $this->escape($this->mainUser->get('email')); ?>" class="required validate-email"
               maxlength="100"
               size="30" <?php if (!empty($this->registration_page)) echo ' aria-required="true" required="required"'; ?>
               onchange="if(this.value!=document.getElementById('register_email').value){alert('<?php echo JText::_('THE_CONFIRMATION_EMAIL_DIFFERS_FROM_THE_EMAIL_YOUR_ENTERED', true); ?>'); this.value = '';}">
    </div>
<?php
}
if (!$this->simplified_registration || $this->simplified_registration == 3) {
    ?>
    <div class=" hikashop_registration_password_line form-input" id="hikashop_registration_password_line">

        <label id="pwmsg" for="register_password" class="required" title="">
            <?php echo JText::_('HIKA_PASSWORD'); ?>
        </label>

        <input type="password" name="data[register][password]" id="register_password" value=""
               class="required validate-password"
               size="30" <?php if (!empty($this->registration_page)) echo ' aria-required="true" required="required"'; ?>>
    </div>
    <div class=" hikashop_registration_password2_line form-input" id="hikashop_registration_password2_line">

        <label id="pw2msg" for="register_password2" class="required" title="">
            <?php echo JText::_('HIKA_VERIFY_PASSWORD'); ?>
        </label>

        <input type="password" name="data[register][password2]" id="register_password2" value=""
               class="required validate-password  error"
               size="30" <?php if (!empty($this->registration_page)) echo ' aria-required="true" required="required"'; ?>>
    </div>
<?php
}
$this->setLayout('custom_fields_bootstrap');
$this->type = 'user';
echo $this->loadTemplate();

if ($this->config->get('affiliate_registration', 0)) {
    ?>
    <div class="control-group hikashop_registration_affiliate_line">
        <div class="controls">
            <?php
            $affiliate_terms = $this->config->get('affiliate_terms', 0);
            if (!empty($affiliate_terms)) {
                ?>
                <input class="hikashop_affiliate_checkbox" id="hikashop_affiliate_checkbox" type="checkbox"
                       name="hikashop_affiliate_checkbox" value="1" <?php echo $this->affiliate_checked; ?> />
                <span class="hikashop_affiliate_terms_span_link" id="hikashop_affiliate_terms_span_link">
				<a class="hikashop_affiliate_terms_link" id="hikashop_affiliate_terms_link" target="_blank"
                   href="<?php echo JRoute::_('index.php?option=com_content&view=article&id=' . $affiliate_terms); ?>"><?php echo JText::_('BECOME_A_PARTNER'); ?></a>
			</span>
            <?php
            } else {
                ?>            <label class="checkbox">
                    <input class="hikashop_affiliate_checkbox" id="hikashop_affiliate_checkbox" type="checkbox"
                           name="hikashop_affiliate_checkbox" value="1" <?php echo $this->affiliate_checked; ?> />
                    <?php echo JText::_('BECOME_A_PARTNER'); ?>
                </label>
            <?php
            }
            ?>
        </div>
    </div>
<?php } ?>
<?php if ($this->config->get('address_on_registration', 1)) { ?>
    <h3 class="widget-head"><?php echo JText::_('ADDRESS_INFORMATION'); ?></h3>
    <?php
    $this->type = 'address';
    echo $this->loadTemplate();

}?>

<div class="control-group hikashop_registration_required_info_line">
    <div class="controls"><?php echo JText::_('HIKA_REGISTER_REQUIRED'); ?></div>
</div>
<input type="hidden" name="data[register][id]" value="<?php echo (int)$this->mainUser->get('id'); ?>"/>
<input type="hidden" name="data[register][gid]" value="<?php echo (int)$this->mainUser->get('gid'); ?>"/>
<?php
if (empty($this->form_name)) {
    $this->form_name = 'hikashop_checkout_form';
}
?>
<div class="control-group">
    <div class="controls">
        <?php
        $registerButtonName = JText::_('HIKA_REGISTER');
        if ($this->simplified_registration == 2) {
            $registerButtonName = JText::_('HIKA_NEXT');
        }
        echo $this->cartClass->displayButton($registerButtonName, 'register', $this->params, '', ' hikashopSubmitForm(\'' . $this->form_name . '\'); return false;', 'id="hikashop_register_form_button"', 0, 1, 'btn btn-small main-bg'); //hikashopSubmitForm(\''.$this->form_name.'\');
        $button = $this->config->get('button_style', 'normal');
        if ($button == 'css')
            echo '<input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;"/></input>';
        ?>
    </div>
</div>
