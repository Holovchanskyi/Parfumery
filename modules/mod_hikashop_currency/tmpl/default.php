<?php
/**
 * @package	HikaShop for Joomla!
 * @version	2.4.0
 * @author	hikashop.com
 * @copyright	(C) 2010-2015 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><?php if(empty($mode_noform)) { ?>
<div class="hikashop_currency_module" id="hikashop_currency_module_<?php echo $module->id; ?>">
	<form action="<?php echo hikashop_completeLink('currency&task=update'); ?>" method="post" name="hikashop_currency_form_<?php echo $module->id; ?>">
		<input type="hidden" name="return_url" value="<?php echo urlencode($redirectUrl); ?>" />
		<?php echo $currency->display('hikashopcurrency',hikashop_getCurrency(),'class="hikashopcurrency" onchange="document.hikashop_currency_form_'.$module->id.'.submit();"'); ?>
	</form>
</div>
<?php } else {
	echo '<div class="hikashop_currency_module" id="hikashop_currency_module_'.$module->id.'">' . $currency->display(null, hikashop_getCurrency(), 'class="hikashopcurrency" id="hikashopcurrency_'.$module->id.'" onchange="window.localPage.switchCurrency(this);"') . '</div>';
	$doc = JFactory::getDocument();
	$doc->addScriptDeclaration('
if(!window.localPage) window.localPage = {};
window.localPage.switchCurrency = function(el) {
	var url = "'.hikashop_completeLink('currency&task=update&hikashopcurrency={ID}').'";
	url += ((url.indexOf("?") !== false) ? "?" : "&") + "return_url='.urlencode($redirectUrl).'";
	window.location = url.replace("{ID}", el.value);
};
');
}
