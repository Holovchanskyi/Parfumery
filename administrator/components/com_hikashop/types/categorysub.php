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
class hikashopCategorysubType {
	var $type='tax';
	var $value='';
	var $multiple = false;

	function load($form = true) {
		static $data = array();
		if(!isset($data[$this->type])){
			$query = 'SELECT category_id FROM '.hikashop_table('category').' WHERE  category_parent_id=0 LIMIT 1';
			$db = JFactory::getDBO();
			$db->setQuery($query);
			$parent = (int)$db->loadResult();
			$select = 'SELECT a.category_name,a.category_id,a.category_namekey';
			$table = ' FROM '.hikashop_table('category') . ' AS a';
			$app = JFactory::getApplication();
			$translationHelper = hikashop_get('helper.translation');

			if($app->isAdmin() && $translationHelper->isMulti()){
				$user = JFactory::getUser();
				$locale = $user->getParam('language');
				if(empty($locale)){
					$config = JFactory::getConfig();
					if(HIKASHOP_J30){
						$locale = $config->get('language');
					}else{
						$locale = $config->getValue('config.language');
					}
				}
				$lgid = $translationHelper->getId($locale);
				$select .= ',b.value';
				$trans_table = 'jf_content';
				if($translationHelper->falang){
					$trans_table = 'falang_content';
				}
				$table .=' LEFT JOIN '.hikashop_table($trans_table,false).' AS b ON a.category_id=b.reference_id AND b.reference_table=\'hikashop_category\' AND b.reference_field=\'category_name\' AND b.published=1 AND language_id='.$lgid;
			}

			static $multiTranslation = null;
			$app = JFactory::getApplication();
			if($multiTranslation === null && !$app->isAdmin()) {
				$translationHelper = hikashop_get('helper.translation');
				$multiTranslation = $translationHelper->isMulti(true);
			}

			$query = $select.$table;
			$query .= ' WHERE  a.category_type = \''.$this->type.'\' AND a.category_parent_id!='.$parent.' ORDER BY a.category_ordering ASC';
			$db->setQuery($query);
			if(!$app->isAdmin() && $multiTranslation && class_exists('JFalangDatabase')){
				$this->categories = $db->loadObjectList('','stdClass',false);
			}elseif(!$app->isAdmin() && $multiTranslation && (class_exists('JFDatabase')||class_exists('JDatabaseMySQLx'))){
				if(HIKASHOP_J25){
					$this->categories = $db->loadObjectList('','stdClass',false);
				}else{
					$this->categories = $db->loadObjectList('',false);
				}
			}else{
				$this->categories = $db->loadObjectList();
			}
			$data[$this->type] =& $this->categories;
		} else {
			$this->categories =& $data[$this->type];
		}

		$this->values = array();
		if($form) {
			if(in_array($this->type,array('status','tax'))){
				$this->values[] = JHTML::_('select.option', '', JText::_('HIKA_NONE') );
			}else{
				$this->values[] = JHTML::_('select.option', 0, JText::_('HIKA_NONE') );
			}
		} else {
			if($this->type=='status'){
				$this->values[] = JHTML::_('select.option', '', JText::_('ALL_STATUSES') );
			}else{
				$this->values[] = JHTML::_('select.option', 0, JText::_('ALL_'.strtoupper($this->type)) );
			}
		}

		if(!empty($this->categories)) {
			foreach($this->categories as $k => $category) {
				if(empty($category->value)){
					$val = str_replace(' ','_',strtoupper($category->category_name));
					$category->value = JText::_($val);
					if($val==$category->value){
						$category->value = $category->category_name;
					}
					$this->categories[$k]->value = $category->value;
				}

				if($this->type=='status'){
					$this->values[] = JHTML::_('select.option', $category->category_name, $category->value );
				}elseif($this->type=='tax'){
					$field = $this->field;
					$this->values[] = JHTML::_('select.option', $category->$field, $category->value );
				}else{
					$this->values[] = JHTML::_('select.option', (int)$category->category_id, $category->value );
				}
			}
		}
	}

	function trans($status) {
		foreach($this->categories as $value){
			if($value->category_name == $status){
				if($this->type == 'status' && $value->value == $status)
					return hikashop_orderStatus($status);
				return $value->value;
			}
		}
		foreach($this->categories as $value){
			if($value->category_namekey == $status){
				if($this->type == 'status' && $value->value == $status)
					return hikashop_orderStatus($status);
				return $value->value;
			}
		}
		if($this->type == 'status')
			return hikashop_orderStatus($status);
		return $status;
	}

	function get($val) {
		foreach($this->values as $value){
			if($value->value == $val) {
				return $value->text;
			}
		}
		return $val;
	}

	function display($map, $value, $form = true, $none = true, $id = '') {
		$this->value = $value;
		if(!is_bool($form)) {
			$attribute = ' '.$form;
			$form = $none;
		} elseif(!$form) {
			$attribute = ' onchange="document.adminForm.submit();"';
		} else {
			$attribute = '';
		}
		$this->load($form);

		if(!in_array($this->type,array('status','tax'))) {
			$value = (int)$value;
		}
		if(strpos($attribute,'size="') === false) {
			if($this->multiple && !HIKASHOP_J30) {
				$attribute.=' size="3"';
			} else {
				$attribute.=' size="1"';
			}
		}
		if($this->multiple){
			$attribute .= ' multiple="multiple"';
			$map .='[]';
		}
		if(!empty($id))
			return JHTML::_('select.genericlist', $this->values, $map, 'class="inputbox"'.$attribute, 'value', 'text', $value , $id);
		return JHTML::_('select.genericlist', $this->values, $map, 'class="inputbox"'.$attribute, 'value', 'text', $value );
	}

	public function displaySingle($map, $value, $type = '', $root = 0, $delete = false) {
		if(empty($this->nameboxType))
			$this->nameboxType = hikashop_get('type.namebox');

		return $this->nameboxType->display(
			$map,
			$value,
			hikashopNameboxType::NAMEBOX_SINGLE,
			'category',
			array(
				'delete' => $delete,
				'root' => $root,
				'default_text' => '<em>'.JText::_('HIKA_NONE').'</em>',
			)
		);
	}

	public function displayMultiple($map, $values, $type = '', $root = 0) {
		if(empty($this->nameboxType))
			$this->nameboxType = hikashop_get('type.namebox');

		$first_element = reset($values);
		if(is_object($first_element))
			$values = array_keys($values);

		return $this->nameboxType->display(
			$map,
			$values,
			hikashopNameboxType::NAMEBOX_MULTIPLE,
			'category',
			array(
				'delete' => true,
				'root' => $root,
				'sort' => true,
				'default_text' => '<em>'.JText::_('HIKA_NONE').'</em>',
			)
		);
	}

	public function displayTree($id, $root = 0, $type = null, $displayRoot = false, $selectRoot = false) {
		hikashop_loadJslib('otree');
		if(empty($type))
			$type = array('product','manufacturer','vendor');
		$ret = '';

		$ret .= '<div id="'.$id.'_otree" class="oTree"></div>
<script type="text/javascript">
var options = {rootImg:"'.HIKASHOP_IMAGES.'otree/", showLoading:false};
var data = '.$this->getData($type, $root, $displayRoot, $selectRoot).';
var '.$id.' = new window.oTree("'.$id.'",options,null,data,false);
'.$id.'.addIcon("world","world.png");
'.$id.'.render(true);
</script>';
		return $ret;
	}

	private function getData($type = 'product', $root = 0, $displayRoot = false, $selectRoot = false) {
		$categoryClass = hikashop_get('class.category');
		if($root == 1)
			$root = 0;
		$elements = $categoryClass->getList($type, $root, $displayRoot);

		$ret = '[';
		$cpt = count($elements)-1;
		$sep = '';
		$rootDepth = 0;
		foreach($elements as $k => $element) {
			$next = null;
			if($k < $cpt)
				$next = $elements[$k+1];

			$status = 4;
			if(!empty($next) && $next->category_parent_id == $element->category_id)
				$status = 2;
			if($element->category_type == 'root') {
				$status = 5;
				$rootDepth = (int)$element->category_depth + 1;
			}
			if(($element->category_id == $root) || ($root == 0 && !$displayRoot && $rootDepth == 0))
				$rootDepth = (int)$element->category_depth;

			$ret .= $sep.'{"status":'.$status.',"name":"'.str_replace('"','&quot;',$element->category_name).'"';

			if($element->category_type == 'root') {
				$ret .= ',"icon":"world"';
				if(!$selectRoot)
					$ret .= ',"noselection":1';
				else
					$ret .= ',"value":'.$element->category_id;
			} else {
				$ret .= ',"value":'.$element->category_id;
			}

			$sep = '';
			if(!empty($next)) {
				if($next->category_depth > $element->category_depth && $element->category_type != 'root') {
					$ret .= ',"data":[';
				} else if($next->category_depth < $element->category_depth) {
					$ret .= '}'.str_repeat(']}', $element->category_depth - $next->category_depth);
					$sep = ',';
				} else {
					$ret .= '}';
					$sep = ',';
				}
			} else {
				$ret .= '}';
				if($element->category_depth >= $rootDepth)
					$ret .= str_repeat(']}', $element->category_depth - $rootDepth);
			}
		}
		$ret .= ']';

		return $ret;
	}
}
