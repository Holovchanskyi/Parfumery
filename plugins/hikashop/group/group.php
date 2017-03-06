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

class plgHikashopGroup extends JPlugin
{
	function __construct(&$subject, $config) {
		parent::__construct($subject, $config);
	}

	function onProductDisplay(&$product,&$html) {
		ob_start();
		?><fieldset class="adminform">
			<legend><?php echo JText::_('USER_GROUP_AFTER_PURCHASE'); ?></legend>
			<?php
				$subscriptiontype = hikashop_get('type.subscription');
				echo $subscriptiontype->display('product_group_after_purchase',@$product->product_group_after_purchase,'product');
			?>
		</fieldset><?php
		$html[]=ob_get_clean();
	}

	function onHikashopBeforeDisplayView(&$view) {
		$app = JFactory::getApplication();
		if(!$app->isAdmin())
			return true;

		$viewName = $view->getName();
	 	$layoutName = $view->getLayout();
		if($viewName != 'checkout' || $layoutName != 'step')
			return true;

		$order = $view->initCart();

		if($this->checkGuest($order))
			return true;

		$sr = explode(',', $view->simplified_registration);
		$remove = null;
		foreach($sr as $k => $r){
			if($r==2) $remove = $k;
		}
		if(!is_null($remove)) unset($sr[$k]);
		$view->simplified_registration = implode(',',$sr);

	}

	function onBeforeUserCreate(&$user,&$do) {
		if(empty($user->user_cms_id)){
			$class = hikashop_get('class.cart');
			$order = $class->loadFullCart();
			$do = $this->checkGuest($order);
		}
	}

	function onBeforeOrderCreate(&$order,&$do) {
		if(isset($order->order_user_id)){
			$class = hikashop_get('class.user');
			$user = $class->get($order->order_user_id);
			if(empty($user->user_cms_id)){
				$do = $this->checkGuest($order);
			}
		}
	}

	function checkGuest(&$order) {
		if(isset($order->cart)){
			$obj =& $order->cart;
		}else{
			$obj =& $order;
		}
		if(!isset($obj->products) || !is_array($obj->products))
			return;
		foreach($obj->products as $product){
			if(!empty($product->product_group_after_purchase) && $product->product_group_after_purchase != 'all' && $product->product_group_after_purchase != '') {
				$app = JFactory::getApplication();
				$app->enqueueMessage(JText::_('GUEST_CHECKOUT_NOT_POSSIBLE_WITH_USER_GROUP_AFTER_PURCHASE'));
				return false;
			}
		}
		return true;
	}

	function onAfterOrderCreate( &$order,&$send_email) {
		return $this->onAfterOrderUpdate( $order,$send_email);
	}

	function onAfterOrderUpdate(&$order,&$send_email) {
		$config =& hikashop_config();
		$confirmed = $config->get('order_confirmed_status');
		if(!isset($order->order_status))
			return true;
		if(!empty($order->order_type) && $order->order_type != 'sale')
			return true;

		$mainframe = JFactory::getApplication();
		$db = JFactory::getDBO();

		$class = hikashop_get('class.order');
		$dbOrder = $class->get($order->order_id);
		$class = hikashop_get('class.user');
		$data = $class->get($dbOrder->order_user_id);

		if(empty($data->user_cms_id) && !$mainframe->isAdmin())
			return true;

		$db->setQuery('SELECT b.*,a.* FROM `#__hikashop_order_product` as a LEFT JOIN `#__hikashop_product` as b ON a.product_id=b.product_id WHERE a.order_id = '.(int) $dbOrder->order_id.' AND b.product_group_after_purchase!=\'\'');
		$allProducts = $db->loadObjectList();

		if(empty($allProducts))
			return true;

		if(empty($data->user_cms_id) && $mainframe->isAdmin()) {
			$mainframe->enqueueMessage('The customer '.$dbOrder->order_user_id.' does not have a joomla user account so his group cannot be changed','notice');
			return true;
		}

		if($order->order_status != $confirmed){
			return true;
		}

		if(!version_compare(JVERSION,'1.6.0','<')){
			jimport('joomla.access.access');
			$userGroups = JAccess::getGroupsByUser($data->user_cms_id, false);
		}
		$user = clone(JFactory::getUser($data->user_cms_id));

		$no_change=true;
		foreach($allProducts as $oneProduct){
			if(hikashop_isAllowed($oneProduct->product_group_after_purchase,$data->user_cms_id)){
				continue;
			}
			$no_change=false;

			if(!version_compare(JVERSION,'1.6.0','<')){
				$userGroups[] = $oneProduct->product_group_after_purchase;
			}else{
				if($user->gid!=25){
					$user->set('gid',$oneProduct->product_group_after_purchase);
					$acl = JFactory::getACL();
					$user->set('usertype', $acl->get_group_name($oneProduct->product_group_after_purchase));
				}
			}

			if($mainframe->isAdmin()){
				$mainframe->enqueueMessage('The user '.$dbOrder->order_user_id.' is now in the group '.$oneProduct->product_group_after_purchase);
			}
		}
		if(!version_compare(JVERSION,'1.6.0','<') && !$no_change){
			$user->set('groups',$userGroups);
			$user->save();
		}

		if($no_change){
			if($mainframe->isAdmin()){
				$mainframe->enqueueMessage('The customer of that order is already in the good user group','notice');
			}
			return true;
		}else{
			$pluginsClass = hikashop_get('class.plugins');
			$plugin = $pluginsClass->getByName('hikashop','group');
			$force_logout = $this->params->get('force_logout');
			if( empty($force_logout) ){
				return true;
			}
			$conf = JFactory::getConfig();
			$handler = $conf->get('session_handler', 'none');
			if($handler=='database'){
				$db->setQuery('DELETE FROM '.hikashop_table('session',false).' WHERE client_id=0 AND userid = '.(int)$data->user_cms_id);
				$db->query();
			}
			if(!$mainframe->isAdmin()){
				$mainframe->logout( $data->user_cms_id );
			}
		}
	}

	function _updateGroup($user_id,$new_group_id,$remove_group_id=0) {
		$user = clone(JFactory::getUser($user_id));
		if(version_compare(JVERSION,'1.6.0','<')){
			if($user->gid!=25){
				$user->set('gid',$new_group_id);
				$acl = JFactory::getACL();
				$user->set('usertype', $acl->get_group_name($new_group_id));
			}
		}else{
			jimport('joomla.access.access');
			$userGroups = JAccess::getGroupsByUser($user_id, true);
			$userGroups[] = $new_group_id;
			if(!empty($remove_group_id)){
				$key = array_search($remove_group_id, $userGroups);
				if(is_int($key)){
					unset($userGroups[$key]);
				}
			}
			$user->set('groups',$userGroups);
		}
		$user->save();
	}
}