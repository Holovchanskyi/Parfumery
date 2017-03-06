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
//    var_dump($oneExtraField);
    $value = '';
    $field_values = explode(',', $this->element->$fieldName);
    if (empty($this->element->$fieldName) && !empty($this->element->main->$fieldName)) $this->element->$fieldName = $this->element->main->$fieldName;
    if (isset($this->element->$fieldName))
        $value = trim($this->element->$fieldName);
    if (!empty ($value) || $value == 0) {
        $displayTitle = true;
        if ($oneExtraField->field_namekey == 'shipping') {
            $displayTitle = true;
            ?>
            <?php echo $this->fieldsClass->show($oneExtraField, $value); ?>

        <?php
        }
    }
//    if($this->element->)
}
$specifFields = ob_get_clean();
if ($displayTitle && ($oneExtraField->field_type !== 'text' || $oneExtraField->field_type !== 'textarea' || $oneExtraField->field_type =='wysiwyg')) {
    echo $specifFields;
}
