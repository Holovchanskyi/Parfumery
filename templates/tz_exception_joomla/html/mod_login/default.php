<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once JPATH_SITE . '/components/com_users/helpers/route.php';

JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');

?>
<a class="close-login" href="#"><i class="fa fa-times"></i></a>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form"
      class="form-inline">
    <?php if ($params->get('pretext')) : ?>
        <div class="pretext">
            <p><?php echo $params->get('pretext'); ?></p>
        </div>
    <?php endif; ?>
    <div class="userdata login-controls">
        <div id="form-login-username" class="skew-25 input-box left">

            <?php if (!$params->get('usetext')) : ?>

                <input id="modlgn-username"
                       type="text"
                       name="username"
                       class="txt-box skew25"
                       tabindex="0"
                       placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>"/>

            <?php else: ?>
                <input id="modlgn-username"
                       type="text"
                       name="username"
                       class="txt-box skew25"
                       tabindex="0"
                       placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>"/>
            <?php endif; ?>

        </div>
        <div id="form-login-password" class="skew-25 input-box left">

            <?php if (!$params->get('usetext')) : ?>

                <input id="modlgn-passwd"
                       type="password"
                       name="password"
                       class="txt-box skew25"
                       tabindex="0"
                       placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>"/>

            <?php else: ?>
                <input id="modlgn-passwd"
                       type="password"
                       name="password"
                       class="txt-box skew25"
                       tabindex="0"
                       placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>"/>
            <?php endif; ?>

        </div>
        <?php if (count($twofactormethods) > 1): ?>
            <div id="form-login-secretkey" class="control-group skew-25">
                <?php if (!$params->get('usetext')) : ?>
                    <div class="input-prepend input-append">
						<span class="add-on">
							<span class="icon-star hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>">
							</span>
								<label for="modlgn-secretkey"
                                       class="element-invisible"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?>
                                </label>
						</span>
                        <input id="modlgn-secretkey" autocomplete="off" type="text" name="secretkey"
                               class="input-small" tabindex="0" size="18"
                               placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>"/>
						<span class="btn width-auto hasTooltip"
                              title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
							<span class="icon-help"></span>
						</span>
                    </div>
                <?php else: ?>
                    <label for="modlgn-secretkey"><?php echo JText::_('JGLOBAL_SECRETKEY') ?></label>
                    <input id="modlgn-secretkey" autocomplete="off" type="text" name="secretkey" class="input-small"
                           tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>"/>
                    <span class="btn width-auto hasTooltip"
                          title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
						<span class="icon-help"></span>
					</span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div id="form-login-submit" class="left skew-25 main-bg">

            <button type="submit" tabindex="0" name="Submit"
                    class="btn skew25 "><?php echo JText::_('EXEC_LOGIN') ?></button>
        </div>
        <?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
            <div id="form-login-remember" class="check-box-box">
                <input id="modlgn-remember" type="checkbox" name="remember" class="check-box" value="yes"/>
                <label for="modlgn-remember">
                    <?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?>
                </label>

                <?php
                $usersConfig = JComponentHelper::getParams('com_users'); ?>
                <a href="<?php echo JRoute::_('index.php?option=com_users&view=reset&Itemid=' . UsersHelperRoute::getResetRoute()); ?>">
                    <?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
            </div>
        <?php endif; ?>


        <input type="hidden" name="option" value="com_users"/>
        <input type="hidden" name="task" value="user.login"/>
        <input type="hidden" name="return" value="<?php echo $return; ?>"/>
        <?php echo JHtml::_('form.token'); ?>
    </div>
    <?php if ($params->get('posttext')) : ?>
        <div class="posttext">
            <p><?php echo $params->get('posttext'); ?></p>
        </div>
    <?php endif; ?>
</form>
