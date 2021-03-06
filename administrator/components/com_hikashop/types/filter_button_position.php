<?php
/**
 * @package	HikaShop for Joomla!
 * @version	2.3.5
 * @author	hikashop.com
 * @copyright	(C) 2010-2015 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><?php
class hikashopFilter_button_positionType{
	function load(){
		$this->values = array();
		$this->values[] = JHTML::_('select.option', 'left',JText::_('HIKA_LEFT'));
		$this->values[] = JHTML::_('select.option', 'right',JText::_('HIKA_RIGHT'));
		$this->values[] = JHTML::_('select.option', 'inside',JText::_('HIKA_INSIDE'));

	}
	function display($map,$value, $options=''){
		$this->load();
		return JHTML::_('select.genericlist',   $this->values, $map, 'class="inputbox" size="1" '.$options, 'value', 'text', $value );
	}
}
