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

// no direct access
defined('_JEXEC') or die;
$doc = JFactory::getDocument();
$bg_contact = '.bg_contact{
 background: url("' . JUri::root() . $params->get('bg_contact') . '") repeat scroll 0 0 #fff;

}';
$doc->addStyleDeclaration($bg_contact);
?>

<?php if ($params->get('show_email_form', 1)): ?>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('#tz-contact-send').click(function () {

                var mailtrue = /^.+@.+\..+$/,
                    tzname = jQuery('#jform_contact_name').val(),
                    namefrom = jQuery('#jform_contact_email').val(),
                    message = jQuery('#jform_contact_message').val();

                <?php if($params -> get('show_subject',1)):?>
                var tzsubject = jQuery('#jform_contact_emailmsg').val();
                <?php endif;?>
                if (!tzname.length) {
                    jQuery('#jform_contact_name').addClass('error');
                    jQuery('#jform_contact_name').focus();
                    document.getElementById('name_error_label').innerHTML = "<?php echo JText::_('MOD_TZ_CONTACT_EMPTY_LABEL');?>";
                    jQuery('#name_error_label').fadeIn(500);
                    jQuery('#name_error_label').fadeOut(2000);
                    return false;
                }

                if (!namefrom.length) {
                    jQuery('#jform_contact_email').addClass('error');
                    jQuery('#jform_contact_email').focus();
                    document.getElementById('email_error_label').innerHTML = "<?php echo JText::_('MOD_TZ_CONTACT_EMPTY_LABEL');?>";
                    jQuery('#email_error_label').fadeIn(500);
                    jQuery('#email_error_label').fadeOut(3000);
                    return false;
                }
                if (mailtrue.test(namefrom) == false) {
                    jQuery('#jform_contact_email').addClass('error');
                    jQuery('#jform_contact_email').focus();
                    document.getElementById('email_error_label').innerHTML = "<?php echo JText::_('MOD_TZ_CONTACT_EMAIL_VALIDATE_LABEL');?>";
                    jQuery('#email_error_label').fadeIn(500);
                    jQuery('#email_error_label').fadeOut(3000);
                    return false;
                }

                if (!message.length) {
                    jQuery('#jform_contact_message').addClass('error');
                    jQuery('#jform_contact_message').focus();
                    document.getElementById('mess_error_label').innerHTML = "<?php echo JText::_('MOD_TZ_CONTACT_EMPTY_LABEL');?>";
                    jQuery('#mess_error_label').fadeIn(500);
                    jQuery('#mess_error_label').fadeOut(3000);
                    return false;
                }

                <?php if($params -> get('show_subject',1)):?>
                if (!tzsubject.length) {
                    jQuery('#jform_contact_emailmsg').addClass('error');
                    jQuery('#jform_contact_emailmsg').focus();
                    document.getElementById('subject_error_label').innerHTML = "<?php echo JText::_('MOD_TZ_CONTACT_EMPTY_LABEL');?>";
                    jQuery('#subject_error_label').fadeIn(500);
                    jQuery('#subject_error_label').fadeOut(3000);
                    return false;

                }
                <?php endif;?>
                jQuery('.contact_sent_loading img').fadeIn(500);

                jQuery.ajax({
                    type: 'post',
                    url: '<?php echo JUri::root().'modules/mod_tz_contact/send.php'?>',
                    data: {
                        id: '<?php echo $contact -> id.':'.$contact -> alias;?>',
                        contact_name: jQuery('#jform_contact_name').val(),
                        contact_email: jQuery('#jform_contact_email').val(),

                        <?php if($params -> get('show_subject',1)):?>
                        contact_subject: jQuery('#jform_contact_emailmsg').val(),
                        <?php endif;?>

                        contact_message: jQuery('#jform_contact_message').val(),
                        contact_email_copy: (jQuery('#jform_contact_email_copy').attr('checked') ? 1 : 0),
                        error: '<?php echo base64_encode(JText::_('MOD_TZ_CONTACT_UNSUCCESSFUL'))?>',
                        recaptcha_response_field: jQuery('#recaptcha_response_field').attr('value'),
                        recaptcha_challenge_field: jQuery('#recaptcha_challenge_field').attr('value'),
                        "<?php echo JSession::getFormToken(); ?>": 1
                    }
                }).success(function (data) {
                        loading.remove();
                        if (data.length) {
                            console.log(data);
                            var json = JSON.parse(data);
                            if (json['success']) {
                                document.getElementById('message').innerHTML = '<?php echo JText::_('MOD_TZ_CONTACT_MESSAGE_SUCCESS_SENT_LABEL')?>';
                                jQuery('#message').fadeIn(1200, function () {

                                    jQuery('#jform_contact_name').val('');
                                    jQuery('#jform_contact_email').val('');

                                    <?php if($params -> get('show_subject',1)):?>
                                    jQuery('#jform_contact_emailmsg').val('');
                                    <?php endif;?>

                                    jQuery('#jform_contact_message').val('');
                                    jQuery('#jform_contact_email_copy').removeAttr('checked');
                                });
                                jQuery('.contact_sent_loading img').fadeOut(1000);
                                jQuery('#message').fadeOut(1200);
                            }
                            else {
                                jQuery('#message-sent-false').text(json['message']).fadeIn(1200, function () {
                                    jQuery(this).fadeOut(1200);
                                });
                            }
                        }
                    });
            });
            jQuery('#tz-contact-reset').click(function () {

                jQuery('#jform_contact_name').val('');
                jQuery('#jform_contact_email').val('');

                <?php if($params -> get('show_subject',1)):?>
                jQuery('#jform_contact_emailmsg').val('');
                <?php endif;?>

                jQuery('#jform_contact_message').val('');
                jQuery('#jform_contact_email_copy').removeAttr('checked');
            });
        });
    </script>
<?php endif; ?>
<div class="TzContact row">
    <?php if ($contact->name && $params->get('show_name', 1)) : ?>

        <h3 class="block-head center">
            <?php if ($contact->published == 0) : ?>
                <span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
            <?php endif; ?>
            <span><span>
                   <?php echo $contact->name; ?>
                </span></span>
        </h3>
    <?php endif; ?>

    <?php if ($params->get('show_misc', 0)): ?>
        <?php if (!empty($contact->misc)): ?>
            <?php
            $class = null;
            if ($params->get('icon_misc')):
                $class = ' span6';
            endif;
            ?>
            <div class="contact-miscinfo">
                <div class="info">
                <span class="contact-misc<?php echo $class; ?>">
                    <?php echo $contact->misc; ?>
                </span>
                </div>
                <div class="contact-icon<?php echo $class; ?>">
                <span class="<?php echo $params->get('marker_class'); ?>">
                <?php echo $params->get('marker_misc'); ?>
                </span>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <div class="cell-6 contact-form fx padd-top-25" data-animate="fadeInLeft" id="contact">
        <?php require JModuleHelper::getLayoutPath('mod_tz_contact', '_form'); ?>

        <?php require JModuleHelper::getLayoutPath('mod_tz_contact', '_address'); ?>
    </div>
    <?php require JModuleHelper::getLayoutPath('mod_tz_contact', '_map'); ?>
    <div class="clearfix"></div>
</div>