<?php
/**
 * @package    HikaShop for Joomla!
 * @version    2.3.3
 * @author    hikashop.com
 * @copyright    (C) 2010-2014 HIKARI SOFTWARE. All rights reserved.
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><?php
global $Itemid;
$Itemid_str = '&Itemid=' . $Itemid;
$cart_type = $this->cart_type;
$userCurrent = hikashop_loadUser(true);
if (isset($userCurrent))
    $userCurrent = $userCurrent->id;
else
    $userCurrent = 0;
if (hikashop_loadUser() == null) {
    echo JText::_('PLEASE_LOGIN_FIRST');
} else {

    ?>
    <div id="hikashop_carts_listing">
        <div class="toolbar hikashop_header_buttons" id="toolbar" style="float: right;">
            <div class="hikashop_no_border">
                <?php
                if ($cart_type == 'cart' && $this->config->get('enable_multicart')) {
                    ?>
                    <a href="<?php echo hikashop_completeLink('cart&task=newcart&cart_type=' . $cart_type . $Itemid_str); ?>"
                       class="btn btn-small main-bg">
							<span class="icon-32-add_cart" title="<?php echo JText::_('NEW_CART'); ?>">
							</span>
                        <?php echo JText::_('NEW_CART'); ?>
                    </a>
                <?php
                } elseif ($cart_type == 'wishlist') {
                    ?>
                    <a href="<?php echo hikashop_completeLink('cart&task=newcart&cart_type=' . $cart_type . $Itemid_str); ?>"
                       class="btn btn-small main-bg">
							<span class="icon-32-add_wishlist" title="<?php echo JText::_('NEW_WISHLIST'); ?>">
							</span>
                        <?php echo JText::_('NEW_WISHLIST'); ?>
                    </a>
                <?php
                }
                ?>

                <?php if ($userCurrent != 0) { ?>

                    <a href="<?php echo JRoute::_('index.php?option=' . HIKASHOP_COMPONENT . '&view=user&layout=cpanel' . $Itemid_str); ?>"
                       class="btn btn-small main-bg">
						<span class="icon-32-back" title="<?php echo JText::_('HIKA_BACK'); ?>">
						</span>
                        <?php echo JText::_('HIKA_BACK'); ?>
                    </a>

                <?php } ?>
            </div>
        </div>
        <div class="iframedoc" id="iframedoc"></div>
        <form action="<?php echo hikashop_completeLink('cart'); ?>" method="post" name="adminForm" id="adminForm">
            <div class="hikashop_no_border">
                <label><?php echo JText::_('FILTER'); ?>:</label>
                <input type="text" name="search" id="hikashop_search"
                       value="<?php echo $this->escape($this->pageInfo->search); ?>" class="inputbox "
                       onchange="document.adminForm.submit();"/>
                <button class="btn btn-small main-bg"
                        onclick="this.form.submit();"><?php echo JText::_('GO'); ?>
                </button>
                <button class="btn btn-small main-bg"
                        onclick="document.getElementById('hikashop_search').value='';this.form.submit();">
                    <?php echo JText::_('RESET'); ?>
                </button>
            </div>
            <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>"/>
            <input type="hidden" name="option" value="<?php echo HIKASHOP_COMPONENT; ?>"/>
            <input type="hidden" name="task" value="showcarts"/>
            <input type="hidden" name="cart_type" value="<?php echo $cart_type; ?>"/>
            <input type="hidden" name="ctrl" value="<?php echo JRequest::getCmd('ctrl'); ?>"/>
            <input type="hidden" name="boxchecked" value="0"/>
            <input type="hidden" name="filter_order" value="<?php echo $this->pageInfo->filter->order->value; ?>"/>
            <input type="hidden" name="filter_order_Dir" value="<?php echo $this->pageInfo->filter->order->dir; ?>"/>
            <?php echo JHTML::_('form.token'); ?>
        </form>
        <table id="hikashop_cart_listing" class="hikashop_carts adminlist table table-style2"
               cellpadding="1">
            <thead>
            <tr>
                <th class="hikashop_cart_num_title title titlenum" align="center">
                    <?php echo JText::_('HIKA_NUM'); ?>
                </th>
                <th class="hikashop_cart_name_title title" align="center">
                    <?php echo JText::_('CART_PRODUCT_NAME'); ?>
                </th>
                <th class="hikashop_cart_quantity_title title" align="center">
                    <?php echo JText::_('PRODUCT_QUANTITY'); ?>
                </th>
                <th class="hikashop_cart_price_title title" align="center">
                    <?php echo JText::_('PRODUCT_PRICE'); ?>
                </th>
                <th class="hikashop_cart_modified_title title" align="center">
                    <?php echo JText::_('HIKA_LAST_MODIFIED'); ?>
                </th>
                <th class="hikashop_cart_current_title title" align="center">
                    <?php echo JText::_('HIKA_CURRENT'); ?>
                </th>
                <th class="hikashop_cart_delete_title title" align="center">
                    <?php echo JText::_('HIKA_DELETE'); ?>
                </th>
            </tr>
            </thead>
            <tfoot id="hikashop_wishlist_listing_pagination">
            <tr>
                <td align="center" colspan="7">
                    <div style="text-align:center;" class="pagination">
                        <form
                            action="<?php echo hikashop_completeLink('cart&task=showcarts&cart_type=' . $cart_type . $Itemid_str); ?>"
                            method="post" name="adminForm_bottom">
                            <?php $this->pagination->form = '_bottom';
                            echo $this->pagination->getListFooter(); ?>
                            <?php echo $this->pagination->getResultsCounter(); ?>
                            <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>"/>
                            <input type="hidden" name="option" value="<?php echo HIKASHOP_COMPONENT; ?>"/>
                            <input type="hidden" name="task" value="showcarts"/>
                            <input type="hidden" name="cart_type" value="<?php echo $cart_type; ?>"/>
                            <input type="hidden" name="ctrl" value="<?php echo JRequest::getCmd('ctrl'); ?>"/>
                            <input type="hidden" name="boxchecked" value="0"/>
                            <input type="hidden" name="filter_order"
                                   value="<?php echo $this->pageInfo->filter->order->value; ?>"/>
                            <input type="hidden" name="filter_order_Dir"
                                   value="<?php echo $this->pageInfo->filter->order->dir; ?>"/>
                            <?php echo JHTML::_('form.token'); ?>
                        </form>
                    </div>
                </td>
            </tr>
            </tfoot>
            <tbody>
            <?php
            $app = JFactory::getApplication();
            $k = 1;
            foreach ($this->carts as $cart) {
                if ($k == 1) $k = 0; else $k = 1;
                if ($cart->cart_id != null && isset($cart->quantity) && isset($cart->price)) {
                    ?>
                    <tr class="hikashop_all_carts row<?php echo $k; ?>">
                        <td data-title="<?php echo JText::_('HIKA_NUM'); ?>">
                            <a href="<?php echo hikashop_completeLink('cart&task=showcart&cart_id=' . $cart->cart_id . '&cart_type=' . $cart_type); ?>"
                               title="<?php echo $cart->cart_id ?>"><?php echo $cart->cart_id; ?></a>
                        </td>
                        <td data-title="<?php echo JText::_('CART_PRODUCT_NAME'); ?>" class="carts_name">
                            <a href="<?php echo hikashop_completeLink('cart&task=showcart&cart_id=' . $cart->cart_id . '&cart_type=' . $cart_type); ?>"
                               title="<?php echo $this->escape(strip_tags($cart->cart_name)); ?>">
                                <?php echo $this->escape(strip_tags($cart->cart_name)); ?>
                            </a>
                        </td>
                        <td data-title="<?php echo JText::_('PRODUCT_QUANTITY'); ?>" class="carts_quantity">
                            <?php echo $cart->quantity; ?>
                        </td>
                        <td data-title="<?php echo JText::_('PRODUCT_PRICE'); ?>" class="carts_price">
                            <?php
                            $config =& hikashop_config();
                            if ($config->get('price_with_tax')) {
                                echo $this->currencyHelper->format($cart->price_with_tax, $cart->currency);
                            }
                            if ($config->get('price_with_tax') == 2) {
                                echo JText::_('PRICE_BEFORE_TAX');
                            }
                            if ($config->get('price_with_tax') == 2 || !$config->get('price_with_tax')) {
                                echo $this->currencyHelper->format($cart->price, $cart->currency);
                            }
                            if ($config->get('price_with_tax') == 2) {
                                echo JText::_('PRICE_AFTER_TAX');
                            }
                            ?>
                        </td>
                        <td data-title="<?php echo JText::_('HIKA_LAST_MODIFIED'); ?>" class="carts_modified">
                            <?php echo hikashop_getDate($cart->cart_modified); ?>
                        </td>
                        <?php
                        if ($userCurrent == $cart->user_id) {
                            $cart_id = $app->getUserState(HIKASHOP_COMPONENT . '.' . $cart_type . '_id', 0, 'int');
                            if ($cart->cart_current == 1 || $cart->cart_id == $cart_id) {
                                ?>
                                <td data-title="<?php echo JText::_('HIKA_CURRENT'); ?>"
                                    class='hikashop_all_carts_current'>
                                    <div class="hikashop_all_carts_current_star"></div>
                                </td>
                            <?php } else { ?>
                                <td data-title="<?php echo JText::_('HIKA_CURRENT'); ?>"
                                    class='hikashop_all_carts_set_current'>
                                    <a href="<?php echo hikashop_completeLink('cart&task=setcurrent&cart_id=' . $cart->cart_id . '&cart_type=' . $cart_type); ?>">
                                        <div class='hikashop_all_carts_set_current_star'></div>
                                    </a>
                                </td>
                            <?php } ?>
                        <?php } else { ?>
                            <td data-title="<?php echo JText::_('HIKA_CURRENT'); ?>"
                                class='hikashop_all_carts_set_current'></td>
                        <?php } ?>
                        <td data-title="<?php echo JText::_('HIKA_DELETE'); ?>" class="hikashop_all_carts_delete">
                            <?php if ($userCurrent == $cart->user_id) { ?>
                                <a href="<?php echo hikashop_completeLink('cart&task=delete&cart_type=' . $cart_type . '&cart_id=' . $cart->cart_id); ?>"
                                   title="<?php echo JText::_('HIKA_DELETE'); ?>" class="remove-item">
                                    <i class="fa fa-times-circle"></i>
                                </a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>
<div class="clear_both"></div>
