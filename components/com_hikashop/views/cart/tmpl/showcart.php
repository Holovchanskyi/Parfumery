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
$cart_type = JRequest::getString('cart_type','cart');
$cart_id = JRequest::getInt('cart_id','');
$tmpl = JRequest::getString('tmpl','view');
global $Itemid;
$url_itemid = '&Itemid='.$Itemid;
if($cart_type == 'wishlist') {
	$addText = JText::_('ADD_TO_CART');
} else{
	$addText = JText::_('ADD_TO_WISHLIST');
}
$app = JFactory::getApplication();
$session = JFactory::getSession();
$userCurrent = hikashop_loadUser(true);
if(isset($userCurrent))
	$userCurrent = $userCurrent->id;
else
	$userCurrent = 0;
$hasAccess = $this->cartVal->user_id == $userCurrent || $this->cartVal->session_id == $session->getId();

if(($this->cartVal->display == 'registered' && $userCurrent == 0) || ($this->cartVal->display == 'link' && JRequest::getString('link',0) == 0)){
	$this->cartVal->display = 0;
}
if(!isset($cart->prices[0])) {
	$cart->prices[0] = new stdClass();
	$cart->prices[0]->price_value = 0;
	$cart->prices[0]->price_value_with_tax = 0;
	$cart->prices[0]->price_currency_id = hikashop_getCurrency();
}

?>
<form method="POST" id="hikashop_show_cart_form" name="hikashop_show_cart_form" action="<?php echo hikashop_completeLink('cart'.$url_itemid);?>">
	<div onload="document.getElementById('task').value='savecart'" id="hikashop_cart_listing">
<?php
	if($tmpl != 'component') {
?>
<fieldset>
	<div class="header hikashop_header_title"><h1><?php if($cart_type == 'cart')echo JText::_('CARTS');else echo JText::_('WISHLISTS'); ?></h1></div>
	<div class="toolbar hikashop_header_buttons" id="toolbar" style="float: right;">
		<table class="hikashop_no_border">
			<tr>
				<td>
<?php
		if($cart_type == 'cart' && $this->config->get('enable_multicart')){
?>
					<a href="<?php echo hikashop_completeLink('cart&task=showcarts&cart_type='.$cart_type.$url_itemid); ?>">
						<span class="icon-32-show_cart" title="<?php echo JText::_('DISPLAY_THE_CARTS'); ?>">
						</span>
						<?php echo JText::_('DISPLAY_THE_CARTS'); ?>
					</a>
<?php
		} elseif($userCurrent == $this->cartVal->user_id && $cart_type == 'wishlist' && $this->config->get('enable_multicart')) {
?>
					<a href="<?php echo hikashop_completeLink('cart&task=showcarts&cart_type='.$cart_type.$url_itemid); ?>">
						<span class="icon-32-show_wishlist" title="<?php echo JText::_('DISPLAY_THE_WISHLISTS'); ?>">
						</span>
						<?php echo JText::_('DISPLAY_THE_WISHLISTS'); ?>
					</a>
<?php
		}
?>
			</td>
			<!-- Wishlist V2
				<td>
					<a title="<?php echo JText::_('HIKA_EMAIL');?>" class="modal" rel="{handler: 'iframe', size: {x: 760, y: 480}}" href="<?php echo hikashop_completeLink('product&task=sendcart',true); ?>">
						<img src="<?php echo HIKASHOP_IMAGES; ?>go.png" alt="<?php echo JText::_('HIKA_EMAIL');?>"/>
					</a>
				</td>
			-->
<?php
		if($this->config->get('print_cart')) {
?>
			<td><?php
				echo $this->popup->display(
					'<span class="icon-32-print" title="'. JText::_('HIKA_PRINT').'"></span>'. JText::_('HIKA_PRINT'),
					'HIKA_PRINT',
					hikashop_completeLink('cart&task=showcart&cart_type='.$cart_type.'&cart_id='.$cart_id,true),
					'hikashop_print_cart',
					760, 480, '', '', 'link'
				);
			?></td>
<?php
		}

		if($this->cartVal->display && $hasAccess){ ?>
				<td>
					<a href="#" onclick="javascript:document.forms['hikashop_show_cart_form'].submit();">
						<span class="icon-32-save" title="<?php echo JText::_('HIKA_SAVE'); ?>"></span> <?php echo JText::_('HIKA_SAVE'); ?>
					</a>
				</td>
<?php
		}
?>
				<td>
				<?php if(!$this->config->get('enable_multicart')) { ?>
					<a href="#" onclick="history.back(); return false;">
				<?php } else { ?>
					<a href="<?php echo JRoute::_('index.php?option='.HIKASHOP_COMPONENT.'&ctrl=cart&task=showcarts&cart_type='.$cart_type.$url_itemid); ?>" >
				<?php } ?>
						<span class="icon-32-back" title="<?php echo JText::_('HIKA_BACK'); ?>"></span> <?php echo JText::_('HIKA_BACK'); ?>
					</a>
				</td>
			</tr>
		</table>
	</div>
</fieldset>
<?php
	} else {
		$js = "window.hikashop.ready( function() {setTimeout(function(){window.focus();window.print();setTimeout(function(){hikashop.closeBox();}, 1000);},1000);});";
		$doc = JFactory::getDocument();
		$doc->addScriptDeclaration("\n<!--\n".$js."\n//-->\n");
	}

	if(($this->cartVal->display && $cart_type == 'wishlist') || ($this->cartVal->display == 'main' && $cart_type == 'cart' && $hasAccess)) {
?>
<div class="iframedoc" id="iframedoc"></div>
<table class="hikashop_showcart_infos table table-striped table-hover" width="100%">
<?php
		if($hasAccess) {
?>
	<tr>
		<td class="key">
			<?php
				if($cart_type != 'wishlist')
					echo JText::_('HIKASHOP_CART_NAME');
				else
					echo JText::_('HIKASHOP_WISHLIST_NAME');
			?>:
		</td>
		<td width="60%">
		<?php if($tmpl != 'component'){ ?>
			<input type="text" id="cart_name" name="cart_name" value="<?php echo $this->escape($this->cartVal->cart_name); ?>" class="inputbox"/>
		<?php }else{ ?>
			<span id="hikashop_wishlist_name" class="hikashop_wishlist_name"><?php echo $this->escape($this->cartVal->cart_name); ?></span>
		<?php } ?>
		</td>
	</tr>
<?php
		}

		if($cart_type != 'cart' && $hasAccess) {

			$baseUrl = JURI::base();
			$baseUrl .= 'index.php?option=com_hikashop&ctrl=';
			$token = '';
			if($this->cartVal->display == 'public') {
				$displayLink = JText::_('HIKASHOP_EVERYBODY');
			} elseif($this->cartVal->display == 'registered') {
				$displayLink = JText::_('HIKASHOP_REGISTERED_USERS');
			} elseif(!$this->cartVal->display || $this->cartVal->display == 'main' || $this->cartVal->display == 'nobody') {
				$this->cartVal->display = 'nobody';
				$displayLink = JText::_('HIKASHOP_NOBODY');
			} else {
				$displayLink = JText::_('HIKA_EMAIL');
				$token = $this->cartVal->display;
				$this->cartVal->display = 'email';
			}
?>
	<tr>
		<td class="key">
			<?php echo JText::_('SHARE'); ?>:
		</td>
		<td>
			<span id="hikashop_wishlist_share" class="hikashop_wishlist_share">
				<select style="width:145px;" id="hikashop_wishlist_share_select" name="cart_share" onChange="showCartLink(this.value);">
					<option value="<?php echo $this->cartVal->display;?>"><?php echo $displayLink; ?></option>
<?php
		 	if($this->cartVal->display != "nobody")
				echo "<option value='nobody'>".JText::_('HIKASHOP_NOBODY')."</option>";
			if($this->cartVal->display != "public")
				echo "<option value='public'>".JText::_('HIKASHOP_EVERYBODY')."</option>";
		 	if($this->cartVal->display != "registered")
				echo "<option value='registered'>".JText::_('HIKASHOP_REGISTERED_USERS')."</option>";
		 	if($this->cartVal->display != "email")
				echo "<option value='email'>".JText::_('HIKA_EMAIL')."</option>";
?>
				</select>
			</span>
			<span class="hikashop_wishlist_share_text" id="hikashop_wishlist_share_text"></span>
		</td>
	</tr>
	<tr width="100%" id='hikashop_wishlist_link' style="display:none;">
		<td  class="key">
			<span class="hikashop_wishlist_link_text"><?php echo JText::_('HIKASHOP_WISHLIST_LINK'); ?>:</span>
		</td>
		<?php if($tmpl != 'component') { ?>
		<td width="60%">
			<input onClick="javascript:this.focus();this.select();" style="width:100%;" readonly="readonly" type="text" id="hikashop_wishlist_link_display" name="hikashop_wishlist_link_display" value=""/>
		</td>
		<?php }else{ ?>
	</tr>
	<tr>
		<td colspan="2"><span class="hikashop_wishlist_link_display_text" id="hikashop_wishlist_link_display_text"></span></td>
		<?php } ?>
	</tr>
<?php
		}
?>
</table>

<table id="hikashop_cart_product_listing" class="hikashop_cart_products adminlist table table-striped table-hover" cellpadding="1">
	<thead>
		<tr>
			<th class="hikashop_cart_num_title title titlenum" align="center">
				<?php echo JText::_( 'HIKA_NUM' );?>
			</th>
			<th class="hikashop_cart_image_title title" align="left">
				<?php echo JText::_( 'HIKA_IMAGE' );?>
			</th>
			<th class="hikashop_cart_name_title title" align="left">
				<?php echo JText::_('CART_PRODUCT_NAME'); ?>
			</th>
			<th class="hikashop_cart_price_title title" align="right">
				<?php echo JText::_('CART_PRODUCT_UNIT_PRICE'); ?>
			</th>
			<th class="hikashop_cart_quantity_title title" align="center">
				<?php echo JText::_('PRODUCT_QUANTITY'); ?>
			</th>
			<th class="hikashop_cart_price_title title" align="right">
				<?php echo JText::_('CART_PRODUCT_TOTAL_PRICE'); ?>
			</th>
			<th class="hikashop_cart_status_title title" align="center">
				<?php echo JText::_('HIKASHOP_CHECKOUT_STATUS'); ?>
			</th>
	<?php if($tmpl != 'component' && hikashop_level(1) && (($this->config->get('enable_wishlist') && $cart_type == 'cart') || $cart_type == 'wishlist')) { ?>
			<th class="hikashop_cart_action_title title" align="center">
				<a  style="cursor: pointer;" onClick="checkAll();"><?php echo JText::_('HIKASHOP_ADD_TO'); ?></a>
			</th>
			<th class="hikashop_cart_delete_title title" align="center">
				<?php echo JText::_('HIKA_DELETE'); ?>
			</th>
	<?php } ?>
		</tr>
	</thead>
	<tfoot>
		<tr class="hika_show_cart_total">
			<td class="hika_show_cart_total_text"><?php
				echo JText::_('HIKASHOP_TOTAL');
			?></td>
			<td></td>
			<td></td>
			<td></td>
			<td align="center" class="hika_show_cart_total_quantity"><?php
				$total_quantity = 0;
				if(!empty($this->rows)) {
					$group = $this->config->get('group_options', 0);
					foreach($this->rows as $cart) {
						if($group && $cart->cart_product_option_parent_id)
							continue;

						if(!@$cart->hide)
							$total_quantity += (int)$cart->cart_product_quantity;
					}
				}
				echo $total_quantity;
			?></td>
			<td align="right" class="hika_show_cart_total_price">
<?php
	if(empty($this->total->prices)) {
		$this->total->prices[0] = new stdClass();
		$this->total->prices[0]->price_value = 0;
		$this->total->prices[0]->price_value_with_tax = 0;
		$this->total->prices[0]->price_currency_id = hikashop_getCurrency();
	}
	if($this->config->get('price_with_tax')) {
		echo $this->currencyHelper->format($this->total->prices[0]->price_value_with_tax, $this->total->prices[0]->price_currency_id);
	}
	if($this->config->get('price_with_tax') == 2) {
		echo JText::_('PRICE_BEFORE_TAX');
	}
	if($this->config->get('price_with_tax') == 2 || !$this->config->get('price_with_tax')) {
		echo $this->currencyHelper->format($this->total->prices[0]->price_value, $this->total->prices[0]->price_currency_id);
	}
	if($this->config->get('price_with_tax') == 2) {
		echo JText::_('PRICE_AFTER_TAX');
	}
?>
			</td>
<?php
	if($tmpl != 'component') {
?>
			<td></td>
<?php
		if(hikashop_level(1) && (($this->config->get('enable_wishlist') && $cart_type == 'cart') || $cart_type == 'wishlist')) {
?>
			<td align="center"><?php
				echo $this->cart->displayButton($addText, 'wishlist', $this->params,hikashop_completeLink('cart&task=convert&cart_type=cart&cart_id='.$cart_id.$url_itemid), 'document.getElementById(\'task\').value = \'addtocart\'; document.forms[\'hikashop_show_cart_form\'].submit(); return false;');
				if($cart_type == 'wishlist' && $this->config->get('show_compare', 0) != 0 && $this->config->get('wishlist_to_compare', 0) != 0)
					echo $this->cart->displayButton(JText::_('HIKASHOP_COMPARE_LIST'), 'wishlist', $this->params, '', 'document.getElementById(\'task\').value = \'addtocart\'; document.getElementById(\'action\').value = \'compare\'; document.forms[\'hikashop_show_cart_form\'].submit(); return false;');
			?></td>
<?php
		}
?>
			<td></td>
<?php
	}
?>
		</tr>
	</tfoot>
	<tbody>
<?php
	$i = 1;
	$k = 1;
	if(!empty($this->rows)) {
		$productClass = hikashop_get('class.product');
		$group = $this->config->get('group_options',0);

		foreach($this->rows as $cart) {
			if($group && $cart->cart_product_option_parent_id)
				continue;

			if(@$cart->hide)
				continue;

			$productClass->addAlias($cart);
			$quantityLeft = $cart->product_quantity - $cart->cart_product_quantity;
			$inStock = 1;
			if(($cart->product_quantity - $cart->cart_product_quantity) >= 0 || $cart->product_quantity == -1) {
				if($cart->product_quantity == -1)
					$stockText = "<span class='hikashop_green_color'>".JText::sprintf('X_ITEMS_IN_STOCK', JText::_('HIKA_UNLIMITED'))."</span>";
				else
					$stockText = "<span class='hikashop_green_color'>".JText::sprintf('X_ITEMS_IN_STOCK', $cart->product_quantity)."</span>";
			} else {
				if($cart->product_code != @$cart->cart_product_code){
					$stockText = "<span class='hikashop_red_color'>".JText::_('HIKA_NOT_SALE_ANYMORE'). "</span>";
				}else{
					$stockText = "<span class='hikashop_red_color'>".JText::_('NOT_ENOUGH_STOCK')."</span>";
				}
				$inStock = 0;
			}
			if($k ==1)$k = 0;else $k =1;
?>
		<tr class="hikashop_show_cart row<?php echo $k; if((int)$cart->cart_product_quantity == 0) echo " hika_wishlist_green";?>">
			<td data-title="<?php echo JText::_('HIKA_NUM'); ?>" align="center"><?php echo $i; ?></td>
			<td data-title="<?php echo JText::_('HIKA_IMAGE'); ?>" align="center">
<?php
			$width = (int)$this->config->get('thumbnail_x');
			$height = (int)$this->config->get('thumbnail_y');
			if(isset($cart->images[0])) {
				$image_options = array(
					'default' => true,
					'forcesize' => $this->config->get('image_force_size', true),
					'scale' => $this->config->get('image_scale_mode','inside')
				);
				$img = $this->image->getThumbnail(@$cart->images[0]->file_path, array('width' => $width, 'height' => $height), $image_options);
				if($img->success) {
					echo '<img class="hikashop_product_cart_image" title="'.$this->escape(@$cart->images[0]->file_description).'" alt="'.$this->escape(@$cart->images[0]->file_name).'" src="'.$img->url.'"/>';
				}
			}
?>
			</td>
			<td data-title="<?php echo JText::_('CART_PRODUCT_NAME'); ?>" align="left">
			<a class="hikashop_no_print" href="<?php echo hikashop_contentLink('product&task=show&cid='.$cart->product_id.'&name='.$cart->alias.$url_itemid,$cart); ?>">
<?php
			if(!isset($cart->bought) || !$cart->bought) {
				echo $cart->product_name;
			} else {
				echo JHTML::tooltip(implode('<br />',$cart->bought), JText::_('HIKA_BOUGHT_BY'), '',$cart->product_name);
			}

			if($this->params->get('show_code')) {
				echo ' ('.$cart->product_code.')';
			}
?>
				</a>
<?php
			$input='';
			if($group) {
				foreach($this->rows as $j => $optionElement) {
					if($optionElement->cart_product_option_parent_id != $cart->cart_product_id)
						continue;
?>
				<p class="hikashop_cart_option_name"><?php
					echo $optionElement->product_name;
				?></p>
<?php
					$input .='document.getElementById(\'cart_product_option_'.$optionElement->cart_product_id.'\').value=qty_field.value;';
					echo '<input type="hidden" id="cart_product_option_'.$optionElement->cart_product_id.'" name="item['.$optionElement->cart_product_id.'][cart_product_quantity]" value="'.$cart->cart_product_quantity.'"/>';
				}

				foreach($this->rows as $j => $optionElement){
					if($optionElement->cart_product_option_parent_id != $cart->cart_product_id) continue;
					if(!empty($optionElement->prices[0])){
						if(!isset($cart->prices[0])){
							$cart->prices[0]->price_value=0;
							$cart->prices[0]->price_value_with_tax=0;
							$cart->prices[0]->price_currency_id = hikashop_getCurrency();
						}
						foreach(get_object_vars($cart->prices[0]) as $key => $value){
							if(is_object($value)){
								foreach(get_object_vars($value) as $key2 => $var2){
									if(strpos($key2,'price_value')!==false) $cart->prices[0]->$key->$key2 +=@$optionElement->prices[0]->$key->$key2;
								}
							}else{
								if(strpos($key,'price_value')!==false) $cart->prices[0]->$key+=@$optionElement->prices[0]->$key;
							}
						}
					}
				}
			}
?>
			</td>
			<td data-title="<?php echo JText::_('CART_PRODUCT_UNIT_PRICE'); ?>" align="right">
<?php
				$this->setLayout('listing_price');
				$this->row=&$cart;
				$this->unit=true;
				echo $this->loadTemplate();
?>
			</td>
			<td data-title="<?php echo JText::_('PRODUCT_QUANTITY'); ?>" align="center" class="hikashop_show_cart_quantity_td">
<?php
			if((empty($cart->product_quantity_layout) && $this->config->get('product_quantity_display', '') == 'show_select') || $cart->product_quantity_layout == 'show_select'){
				$min_quantity = $cart->product_min_per_order;
				$max_quantity = $cart->product_max_per_order;
				if($min_quantity == 0)
					$min_quantity = 1;
				if($max_quantity == 0)
					$max_quantity = (int)$min_quantity * 15;
?>
				<select id="hikashop_showcart_quantity_select_<?php echo $cart->cart_product_id;?>" class="tochosen" onchange="var qty_field = document.getElementById('hikashop_product_quantity_field_<?php echo $cart->product_id;?>'); qty_field.value = this.value; if (qty_field){<?php echo $input; ?> } return false;">
<?php
				for($j = $min_quantity; $j <= $max_quantity; $j += $min_quantity){
					$selected = '';
					if($j == $cart->cart_product_quantity)
						$selected = 'selected="selected"';
					echo '<option value="'.$j.'" '.$selected.'>'.$j.'</option>';
				}
?>
				</select>
				<input id="hikashop_product_quantity_field_<?php echo $cart->product_id;?>" type="hidden" name="item[<?php echo $cart->cart_product_id;?>]" class="hikashop_show_cart_quantity"  value="<?php echo $cart->cart_product_quantity; ?>" />
<?php
			} else {
?>
				<input id="hikashop_product_quantity_field_<?php echo $cart->product_id;?>" type="text" name="item[<?php echo $cart->cart_product_id;?>]" class="hikashop_show_cart_quantity"  value="<?php echo $cart->cart_product_quantity; ?>" />
<?php
			}
?>
				<div class="hikashop_cart_product_quantity_refresh">
					<a class="hikashop_no_print" href="#" onclick="var qty_field = document.getElementById('hikashop_product_quantity_field_<?php echo $cart->product_id;?>'); if (qty_field && qty_field.value != '<?php echo $cart->cart_product_quantity; ?>'){<?php echo $input; ?> qty_field.form.submit(); } return false;" title="<?php echo JText::_('HIKA_REFRESH'); ?>">
						<img src="<?php echo HIKASHOP_IMAGES . 'refresh.png';?>" border="0" alt="<?php echo JText::_('HIKA_REFRESH'); ?>" />
					</a>
				</div>
			</td>
			<td data-title="<?php echo JText::_('CART_PRODUCT_TOTAL_PRICE'); ?>" align="right">
<?php
				$this->setLayout('listing_price');
				$this->row=&$cart;
				$this->unit=false;
				echo $this->loadTemplate();
?>
			</td>
			<td data-title="<?php echo JText::_('HIKASHOP_CHECKOUT_STATUS'); ?>" align="center"><?php echo $stockText;?></td>
<?php
			if($tmpl != 'component'){
				if(hikashop_level(1) && (($this->config->get('enable_wishlist') && $cart_type == 'cart') || $cart_type == 'wishlist')) {
?>
			<td data-title="<?php echo JText::_('HIKASHOP_ADD_TO'); ?>"  align="center" class="hikashop_show_cart_add">
<?php
?>
				<input type="checkbox" name="data[products][<?php echo $cart->product_id;?>][checked]" value="1"/>
			</td>
<?php
				}

				if($hasAccess) {
?>
			<td data-title="<?php echo JText::_('HIKA_DELETE'); ?>" align="center" class="hikashop_show_cart_delete">
				<a class="hikashop_no_print" href="<?php echo hikashop_completeLink('product&task=updatecart&stay=1&delete=1&quantity=0&cart_type='.$cart_type.'&cart_id='.$cart->cart_id.'&cart_product_id='.$cart->cart_product_id.'&return_url='.urlencode(base64_encode(hikashop_currentURL())).$url_itemid); ?>"  title="<?php echo JText::_('HIKA_DELETE'); ?>">
					<img src="<?php echo HIKASHOP_IMAGES . 'delete2.png';?>" border="0" alt="<?php echo JText::_('HIKA_DELETE'); ?>" />
				</a>
			</td>
<?php
				}
			}
?>
		</tr>
<?php
			$i++;
		} // end of foreach

		if($cart_type == 'wishlist')
			echo '<input type="hidden" name="add_to" value="cart"/>';
		else
			echo '<input type="hidden" name="add_to" value="wishlist"/>';
	}
?>
	</tbody>
</table>
<?php

	if($cart_type != 'cart' && $hasAccess) {
?>
<script type="text/javascript">
window.hikashop.ready(function(){
	var d = document,
		link = d.getElementById('hikashop_wishlist_link'),
		linkDisplay = d.getElementById('hikashop_wishlist_link_display'),
		linkDisplayText = d.getElementById('hikashop_wishlist_link_display_text'),
		linkShare = d.getElementById('hikashop_wishlist_share'),
		linkShareSelect = d.getElementById('hikashop_wishlist_share_select').value,
		linkShareText = d.getElementById('hikashop_wishlist_share_text');

	if(linkShareSelect == 'public') linkShareText.innerHTML = 'Anybody';
	else if(linkShareSelect == 'registered') linkShareText.innerHTML = 'Registered users';
	else if(linkShareSelect == 'email') linkShareText.innerHTML = 'E-mail';
	else linkShareText.innerHTML = 'Nobody';

	if(linkShareSelect == 'email'){
		link.style.display="table-row";
		if(linkDisplay){
			linkDisplay.value = "<?php echo $baseUrl.'cart&task=showcart&cart_id='.$cart_id.'&cart_type='.$cart_type.$url_itemid.'&link='.$token ?>";
			linkShareText.style.display="none";
		}
		if(linkDisplayText){
			linkDisplayText.innerHTML = "<?php echo $baseUrl.'cart&task=showcart&cart_id='.$cart_id.'&cart_type='.$cart_type.$url_itemid.'&link='.$token ?>";
			linkShare.style.display="none";
		}
	}else if(linkShareSelect == 'nobody'){
		link.style.display="none";
		if(linkDisplay){
			linkShareText.style.display="none";
		}else{
			linkShare.style.display="none";
		}
	}else{
		link.style.display="table-row";
		if(linkDisplay){
			linkDisplay.value = "<?php echo $baseUrl.'cart&task=showcart&cart_id='.$cart_id.'&cart_type='.$cart_type.$url_itemid; ?>";
			linkShareText.style.display="none";
		}
		if(linkDisplayText){
			linkDisplayText.innerHTML = "<?php echo $baseUrl.'cart&task=showcart&cart_id='.$cart_id.'&cart_type='.$cart_type.$url_itemid; ?>";
			linkShare.style.display="none";
		}
	}
});

function showCartLink(share){
	var d = document,
		link = d.getElementById('hikashop_wishlist_link'),
		linkShareText = d.getElementById('hikashop_wishlist_share_text'),
		linkDisplay = d.getElementById('hikashop_wishlist_link_display'),
		linkDisplayText = d.getElementById('hikashop_wishlist_link_display_text');

	link.style.display="none";

	if(share == 'public') linkShareText.innerHTML = 'Anybody';
	else if(share == 'registered') linkShareText.innerHTML = 'Registered users';
	else if(share == 'email') linkShareText.innerHTML = 'E-mail';
	else linkShareText.innerHTML = 'Nobody';

	if(share == 'public' || share == 'registered'){
		if(linkDisplay)
			linkDisplay.value = "<?php echo $baseUrl.'cart&task=showcart&cart_id='.$cart_id.'&cart_type='.$cart_type.$url_itemid; ?>";
		if(linkDisplayText)
			linkDisplayText.innerHTML = "<?php echo $baseUrl.'cart&task=showcart&cart_id='.$cart_id.'&cart_type='.$cart_type.$url_itemid; ?>";
		link.style.display="table-row";
	} else if(share == 'email'){
		<?php
			$chaine = "abcdefghijklmnpqrstuvwxy0123456789";
			srand((double)microtime()*1000000);
			for($i=0; $i<20; $i++) {
				$token .= $chaine[rand()%strlen($chaine)];
			}
			$tokenLink = '&link='.$token;
		?>
		if(linkDisplay)
			linkDisplay.value = "<?php echo $baseUrl.'cart&task=showcart&cart_id='.$cart_id.'&cart_type='.$cart_type.$url_itemid.$tokenLink ?>";
		if(linkDisplayText)
			linkDisplayText.innerHTML = "<?php echo $baseUrl.'cart&task=showcart&cart_id='.$cart_id.'&cart_type='.$cart_type.$url_itemid.$tokenLink ?>";
		link.style.display="table-row";
	} else{
		link.style.display="none";
	}
	link.focus();
}
</script>
	<input type="hidden" name="hikashop_wishlist_token" value="<?php echo $token; ?>"/>
<?php
		}

		if($cart_type == 'cart' && $total_quantity > 0 && hikashop_level(1) && $this->config->get('enable_wishlist') && $tmpl != 'component') {
			$this->params->set('cart_type','wishlist');
			echo $this->cart->displayButton(JText::_('CART_TO_WISHLIST'), 'wishlist', $this->params, hikashop_completeLink('cart&task=convert&cart_type=cart&cart_id='.$cart_id.$url_itemid), 'window.location.href = \''.hikashop_completeLink('cart&task=convert&cart_type=cart&cart_id='.$cart_id.$url_itemid,false,false,true).'\';return false;');
		}
		$itemid_for_checkout = (int)$this->config->get('checkout_itemid','0');
		if(empty($itemid_for_checkout)){
			$menuClass = hikashop_get('class.menus');
			$itemid_for_checkout = $menuClass->getCheckoutMenuIdForURL();
		}
		if(!empty($itemid_for_checkout)){
			$url_checkout = hikashop_completeLink('checkout&Itemid='.$itemid_for_checkout);
		}else{
			$url_checkout = hikashop_completeLink('checkout'.$url_itemid);
		}
		if($cart_type == 'cart' && $this->params->get('show_cart_proceed',1)) echo $this->cart->displayButton(JText::_('PROCEED_TO_CHECKOUT'),'checkout',$this->params,$url_checkout,'');
	} else {
		echo "<div class='hikashop_not_authorized'>".JText::_('HIKASHOP_NOT_AUTHORIZED')."</div>";
	}
?>
	</div>
	<div class="clear_both"></div>
	<input type="hidden" id="task" name="task" value="savecart"/>
	<input type="hidden" name="cid" value=""/>
	<input type="hidden" name="cart_id" value="<?php echo $cart_id; ?>"/>
	<input type="hidden" name="from_id" value="<?php echo $cart_id; ?>"/>
	<input type="hidden" name="cart_type" value="<?php echo $cart_type; ?>"/>
	<input type="hidden" id="action" name="action" value=""/>
</form>
