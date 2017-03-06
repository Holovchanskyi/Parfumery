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
class hikashopProductdisplayType {
	var $default = array(
		'show_default',
		'show_reversed',
		'show_tabular'
	);

	function load(){
		$this->values = array();
		if(JRequest::getCmd('from_display',false) == false)
			$this->values[] = JHTML::_('select.option', '', JText::_('HIKA_INHERIT'));
		$this->values[] = JHTML::_('select.optgroup', '-- '.JText::_('FROM_HIKASHOP').' --');
		foreach($this->default as $d) {
			$this->values[] = JHTML::_('select.option', $d, JText::_(strtoupper($d)));
		}
		if(version_compare(JVERSION,'1.6.0','>=')){
			$this->values[] = JHTML::_('select.optgroup', '-- '.JText::_('FROM_HIKASHOP').' --');
		}

		$closeOpt = '';
		$values = $this->getLayout();
		foreach($values as $value) {
			if(substr($value,0,1) == '#') {
				if(version_compare(JVERSION,'1.6.0','>=') && !empty($closeOpt)){
					$this->values[] = JHTML::_('select.optgroup', $closeOpt);
				}
				$value = substr($value,1);
				$closeOpt = '-- ' . JText::sprintf('FROM_TEMPLATE',basename($value)) . ' --';
				$this->values[] = JHTML::_('select.optgroup', $closeOpt);
			} else {
				$this->values[] = JHTML::_('select.option', $value, $value);
			}
		}
		if(version_compare(JVERSION,'1.6.0','>=') && !empty($closeOpt)){
			$this->values[] = JHTML::_('select.optgroup', $closeOpt);
		}
	}

	function display($map,$value) {
		$this->load();
		return JHTML::_('select.genericlist', $this->values, $map, 'class="inputbox" size="1"', 'value', 'text', $value );
	}

	function check($name,$template) {
		if($name == '' || in_array($name, $this->default))
			return true;
		$values = $this->getLayout($template);
		return in_array($name,$values);
	}

	function getLayout($template = '') {
		jimport('joomla.filesystem.folder');
		jimport('joomla.filesystem.file');
		static $values = null;
		if($values !== null)
			return $values;
		$client	= JApplicationHelper::getClientInfo(0); // 0: Front client
		$tplDir = $client->path.DS.'templates'.DS;
		$values = array();
		if(empty($template)) {
			$templates = JFolder::folders($tplDir);
			if(empty($templates))
				return null;
		} else {
			$templates = array($template);
		}
		$groupAdded = false;
		foreach($templates as $tpl) {
			$t = $tplDir.$tpl.DS.'html'.DS.HIKASHOP_COMPONENT.DS;
			if(!JFolder::exists($t))
				continue;
			$folders = JFolder::folders($t);
			if(empty($folders))
				continue;
			foreach($folders as $folder) {
				$files = JFolder::files($t.$folder.DS);
				if(empty($files))
					continue;
				foreach($files as $file) {
					if(substr($file,-4) == '.php')
						$file = substr($file,0,-4);
					if(substr($file,0,5) == 'show_' && substr($file,0,14) != 'show_quantity_' && !in_array($file,$this->default)) {
						if(!$groupAdded) {
							$values[] = '#'.$tpl;
							$groupAdded = true;
						}
						$values[] = $file;
					}
				}
			}
		}
		return $values;
	}

	public function displaySingle($map, $value, $display = '', $root = 0, $delete = false) {
		hikashop_loadJslib('jquery');
		hikashop_loadJslib('otree');
		$id = str_replace(array('[',']'),array('_',''),$map);

		$key = '';
		$name = '<em>'.JText::_('HIKA_NONE').'</em>';
		$cleanText = '<em>'.str_replace("'", "\\'", JText::_('HIKA_NONE')).'</em>';
		$productClass = hikashop_get('class.product');
		if((int)$value > 0) {
			$product = $productClass->get((int)$value);
			if($product) {
				$key = (int)$value;
				$name = $product->product_name;
			}
		}

		$displayParam = '';
		if(!empty($display)) {
			$displayParam = '&display=' . urlencode($display);
		}
		$shopConfig = hikashop_config(false);
		$minSearch = $shopConfig->get('product_search_min_lenght', 3);
		$jsEvent = 'window.oNameboxes[\''.$id.'\'].search(this);';

		$elements = $productClass->getTreeList((int)$root, 2, true, $display);

		$ret = '
<div class="nameboxes" id="'.$id.'" onclick="window.oNameboxes[\''.$id.'\'].focus(\''.$id.'_text\');">
	<div class="namebox" id="'.$id.'_namebox">
		<input type="hidden" name="'.$map.'" id="'.$id.'_valuehidden" value="'.$key.'"/><span id="'.$id.'_valuetext">'.$name.'</span>
		'.(!$delete?'<a class="editbutton" href="#" onclick="return false;"><span>-</span></a>':
		'<a class="closebutton" href="#" onclick="window.oNameboxes[\''.$id.'\'].clean(this,\''.$cleanText.'\');return false;"><span>X</span></a>').'
	</div>
	<div class="nametext">
		<input id="'.$id.'_text" type="text" style="width:50px;min-width:60px" onfocus="window.oNameboxes[\''.$id.'\'].focus(this);" onblur="" onkeyup="'.$jsEvent.'" onchange="'.$jsEvent.'"/>
		<span style="position:absolute;top:0px;left:-2000px;visibility:hidden" id="'.$id.'_span">span</span>
	</div>
	<div class="hikaclear" style="clear:both;float:none;"></div>
</div>
<div class="namebox-popup">
	<div id="'.$id.'_otree" style="display:none;" class="oTree namebox-popup-content"></div>
</div>
<script type="text/javascript">
new window.oNamebox(
	\''.$id.'\',
	'.json_encode($elements).',
	{
		mode:\'tree\',
		multiple:false,
		img_dir:\''.HIKASHOP_IMAGES.'\',
		map:\''.$map.'\',
		tree_url:\''.hikashop_completeLink('product&task=getTree'.$displayParam .'&category_id=HIKACATID', false, false, true).'\',
		tree_key:\'HIKACATID\',
		url:\''.hikashop_completeLink('product&task=findTree'.$displayParam .'&search=HIKASEARCH', false, false, true) . '\',
		url_keyword: \'HIKASEARCH\',
		onlyNode:true,
	}
);
</script>';
		return $ret;
	}

	public function displayMultiple($map, $values, $display = '', $root = 0) {
		if(substr($map,-2) == '[]')
			$map = substr($map,0,-2);
		$id = str_replace(array('[',']'),array('_',''),$map);

		$ret = '<div class="nameboxes" id="'.$id.'" onclick="window.oNameboxes[\''.$id.'\'].focus(\''.$id.'_text\');">';

		if(!empty($values)) {
			foreach($values as $key => $name) {
				$obj = null;
				if(is_object($name)) {
					$obj = $name;
					$name = $obj->product_name;
					$key = $obj->product_id;
				}
				$ret .= '<div class="namebox" id="'.$id.'-'.$key.'">'.
					'<input type="hidden" name="'.$map.'[]" value="'.$key.'"/>'.$name.
					' <a class="closebutton" href="#" onclick="window.oNamebox.deleteId(\''.$id.'_'.$key.'\');window.oNamebox.cancelEvent();return false;"><span>X</span></a>'.
					'</div>';
			}
		}
		$ret .= '<div class="namebox" style="display:none;" id="'.$id.'tpl">'.
			'<input type="hidden" name="{map}" value="{key}"/>{name}'.
			' <a class="closebutton" href="#" onclick="window.oNamebox.deleteId(this.parentNode);window.oNamebox.cancelEvent();return false;"><span>X</span></a>'.
			'</div>';
		$ret .= '<div class="nametext">'.
			'<input id="'.$id.'_text" type="text" style="width:50px;min-width:60px" onfocus="window.oNameboxes[\''.$id.'\'].focus(this);" onkeyup="window.oNameboxes[\''.$id.'\'].search(this);" onchange="window.oNameboxes[\''.$id.'\'].search(this);"/>'.
			'<span style="position:absolute;top:0px;left:-2000px;visibility:hidden" id="'.$id.'_span">span</span>'.
			'</div>';

		$ret .= '<div style="clear:both;float:none;"></div></div>';

		hikashop_loadJslib('jquery');
		hikashop_loadJslib('otree');

		$config = hikashop_config(false);
		$minSearch = $config->get('product_search_min_lenght', 3);

		$productClass = hikashop_get('class.product');
		$elements = $productClass->getTreeList((int)$root, 2, true, $display);

		$displayParam = '';
		if(!empty($display))
			$displayParam = '&display=' . urlencode($display);

		$ret .= '
<div class="namebox-popup">
<div id="'.$id.'_otree" style="display:none;" class="oTree namebox-popup-content"></div>
</div>
<script type="text/javascript">
new window.oNamebox(
	\''.$id.'\',
	'.json_encode($elements).',
	{
		mode:\'tree\',
		img_dir:\''.HIKASHOP_IMAGES.'\',
		map:\''.$map.'\',
		tree_url:\''.hikashop_completeLink('product&task=getTree'.$displayParam .'&category_id=HIKACATID', false, false, true).'\',
		tree_key:\'HIKACATID\',
		url:\''.hikashop_completeLink('product&task=findTree'.$displayParam .'&search=HIKASEARCH', false, false, true) . '\',
		url_keyword: \'HIKASEARCH\',
		onlyNode:true,
		sort:true
	}
);
</script>';
		return $ret;
	}
}
