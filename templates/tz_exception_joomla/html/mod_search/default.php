<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_search
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<a href="#"><span class="fa fa-search"></span></a>
<div class="search<?php echo $moduleclass_sfx ?> search-box">
    <form action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-inline">
        <?php
        $output = '';
        $output .= '<div class="input-box left">
                    <input name="searchword" id="mod-search-searchword" maxlength="' . $maxlength . '"  class="txt-box" type="text" size="' . $width . '" value="' . $text . '"  onblur="if (this.value==\'\') this.value=\'' . $text . '\';" onfocus="if (this.value==\'' . $text . '\') this.value=\'\';" />
                    </div>';

        if ($button) :
            if ($imagebutton) :
                $btn_output = '<div class="left">
                                <input type="image" value="' . $button_text . '" class="btn main-bg" src="' . $img . '" onclick="this.form.searchword.focus();"/>
                                </div>';
            else :
                $btn_output = '<div class="left">
                                <button class="btn main-bg" onclick="this.form.searchword.focus();">' . $button_text . '</button>
                                </div>';
            endif;

            switch ($button_pos) :
                case 'top' :
                    $output = $btn_output . '<br />' . $output;
                    break;

                case 'bottom' :
                    $output .= '<br />' . $btn_output;
                    break;

                case 'right' :
                    $output .= $btn_output;
                    break;

                case 'left' :
                default :
                    $output = $btn_output . $output;
                    break;
            endswitch;

        endif;

        echo $output;
        ?>
        <input type="hidden" name="task" value="search"/>
        <input type="hidden" name="option" value="com_search"/>
        <input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>"/>
    </form>

</div>