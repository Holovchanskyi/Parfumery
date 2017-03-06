<?php
/**
 * @package	HikaShop for Joomla!
 * @version	2.4.0
 * @author	hikashop.com
 * @copyright	(C) 2010-2015 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><?php
class hikashopQuantityType {
	protected $values = array();

	protected function load($config) {
		$this->values = array();
		if($config) {
			$this->values[] = JHTML::_('select.option', 2,JText::_('GLOBAL_ON_LISTINGS'));
			$this->values[] = JHTML::_('select.option', -2,JText::_('ON_A_PER_PRODUCT_BASIS'));
		}
		$this->values[] = JHTML::_('select.option', 1,JText::_('AJAX_INPUT'));
		$this->values[] = JHTML::_('select.option', -1,JText::_('NORMAL_INPUT'));
		$this->values[] = JHTML::_('select.option', 0,JText::_('NO_DISPLAY'));
	}

	public function display($map, $value, $config = true) {
		$this->load($config);
		return JHTML::_('select.genericlist', $this->values, $map, 'class="inputbox" size="1"', 'value', 'text', (int)$value);
	}

	public function displayInput($map, $value) {
		$attribs = '';
		$label = '';
		$id = str_replace(array('][','[',']'),array('__','_',''), $map);

		$ret = '<input type="text" name="'.$map.'" id="'.$id.'" value="'.$value.'" '.$attribs.'/>'.
			'<a class="marketInfinityButton" href="#" onclick="document.getElementById(\''.$id.'\').value=\''.JText::_('UNLIMITED').'\';return false;"><span>X</span></a>';
		return $ret;
	}
}
