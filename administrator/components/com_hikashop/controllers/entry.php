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
class EntryController extends hikashopController{
	var $type='entry';
	var $pkey = 'entry_id';
	var $table = 'entry';
	function __construct(){
		parent::__construct();
		$this->display[]='export';
	}
	function export(){
		$cids = JRequest::getVar('cid');
		if(!empty($cids)){
			$_SESSION['hikashop']['entries'] = $cids;
		}else{
			$_SESSION['hikashop']['entries'] = '';
		}
		JRequest::setVar( 'layout', 'export'  );
		return parent::display();
	}
}
