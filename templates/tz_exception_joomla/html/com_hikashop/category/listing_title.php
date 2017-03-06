<?php
/**
 * @package    HikaShop for Joomla!
 * @version    2.3.3
 * @author    hikashop.com
 * @copyright    (C) 2010-2014 HIKARI SOFTWARE. All rights reserved.
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><?php $link = $this->getLink($this->row);?>

<li>
    <a href="<?php echo $link; ?>">
        <?php echo $this->row->category_name; ?>

    </a>
    <span>
    <?php if ($this->params->get('number_of_products', 0)) {
        echo ' [' . $this->row->number_of_products . ']';
    }
    ?>
        </span>
</li>