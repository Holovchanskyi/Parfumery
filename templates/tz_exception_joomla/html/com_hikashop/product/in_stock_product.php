<?php
/**
 * @package    HikaShop for Joomla!
 * @version    2.3.3
 * @author    hikashop.com
 * @copyright    (C) 2010-2014 HIKARI SOFTWARE. All rights reserved.
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?>
<?php



$config =& hikashop_config();
if ($this->row->product_quantity > 0) :
    if ($this->config->get('show_out_of_stock') == 1):
        ?>
        <div class="success-box left"><i class="<?php echo JText::_('TPL_EXEC_ICON_IN_STOCK_HIKA_SHOP') ?>"></i></div>
        <?php
        if ($this->row->product_quantity == 1) {
            if (JText::_('X_ITEM_IN_STOCK') == 'X_ITEM_IN_STOCK') {
                $text = JText::sprintf('X_ITEMS_IN_STOCK', $this->row->product_quantity);
            } else {
                $text = JText::sprintf('X_ITEM_IN_STOCK', $this->row->product_quantity);
            }
        } else {
            $text = JText::sprintf('X_ITEM_IN_STOCK', $this->row->product_quantity);
        }

        echo '<span class="hikashop_product_stock_count">' . $text . '</span>';?>
    <?php endif; ?>
<?php endif; ?>
