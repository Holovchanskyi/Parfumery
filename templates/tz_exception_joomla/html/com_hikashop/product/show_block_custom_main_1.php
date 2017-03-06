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
$this->fieldsClass->prefix = '';
$displayTitle = false;
ob_start();
foreach ($this->fields as $fieldName => $oneExtraField) {
    $value = '';
    $field_values = explode(',', $this->element->$fieldName);
    if (empty($this->element->$fieldName) && !empty($this->element->main->$fieldName)) $this->element->$fieldName = $this->element->main->$fieldName;
    if (isset($this->element->$fieldName))
        $value = trim($this->element->$fieldName);
    if (!empty ($value) || $value == 0) {
        $displayTitle = true;
        if ($oneExtraField->field_type == 'checkbox') {
            $displayTitle = true;
            ?>
            <div id="hikashop_product_custom_info_main"
                 class="hikashop_product_custom_info_main product-specs product-block list-item">
                <div class="label_custom">
                    <?php if ($oneExtraField->field_namekey == 'sizeproduct') {
                        echo '<i class="fa fa-paper-plane-o"></i>';

                    }?>
                    <?php if ($oneExtraField->field_namekey == 'color') {
                        echo '<i class="fa fa-camera"></i>';

                    }?>
                    <?php echo $this->fieldsClass->getFieldName($oneExtraField); ?>
                </div>

                <?php

                foreach ($field_values as $field_value) {
                    ?>
                    <?php echo ' <a class="btn btn-small btn-border">' . $field_value . '</a>'; ?>
                <?php
                }?>
            </div>

        <?php
        }
    }
//    if($this->element->)
}
$specifFields = ob_get_clean();
if ($displayTitle) {
    echo $specifFields;
}
