<?php

/*------------------------------------------------------------------------

# MOD_TZ_NEW_PRO Extension

# ------------------------------------------------------------------------

# author    TuanNATemplaza

# copyright Copyright (C) 2013 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/
// no direct access

defined('_JEXEC') or die;
?>
<?php if ($list): ?>
    <?php if ($params->get('animate', '')): ?>
    <div class="fx" data-animate="<?php echo $params->get('animate', '') ?>">
        <?php endif; ?>
          
        
        <table>
            <tbody>
                <tr style="border: 0 !important;">
                    <td colspan="2">
                        <div class="level-name">Выбрать товар</div>
                        <div class="level-out">
                            <span></span>
                            <div class="level-in" data-percent="100"></div>
                            <div class="clearfix"></div>
                        </div>
                    </td>
                    
                    <td width="20%">
                        <img width="200" height="200" src="/images/how_buy/select.png">
                    </td>
                    <td width="20%"></td>
                    <td width="20%"></td>
                    <td width="20%"></td>
                    
                </tr>
                
                <tr style="border: 0 !important; background: none;">
                    
                    <td colspan="3">
                        <div class="level-name">Оплатить заказ</div>
                <div class="level-out">
                    <span></span>
                    <div class="level-in" data-percent="100"></div>
                    <div class="clearfix"></div>
                </div>
                    </td>
                
                    <td width="20%">
                    <img width="200" height="200" src="/images/how_buy/buy.png">
                    </td>
                    <td width="20%"></td>
                    <td width="20%"></td>
                    
                </tr>
                
                <tr style="border: 0 !important;">
                    
                    <td colspan="4">
                        <div class="level-name">Подтверждение заказа</div>
                <div class="level-out">
                    <span></span>
                    <div class="level-in" data-percent="100"></div>
                    <div class="clearfix"></div>
                </div>
                    </td>
                    
                    <td width="20%">
                    <img width="200" height="200" src="/images/how_buy/consultation.png">
                    </td>
                    <td width="20%"></td>
                    
                </tr>
                
                <tr style="background: none; border: 0 !important;">
                    
                    <td colspan="5">
                        <div class="level-name">Доставка курьером или на отделение НП</div>
                <div class="level-out">
                    <span></span>
                    <div class="level-in" data-percent="100"></div>
                    <div class="clearfix"></div>
                </div>
                    </td>
                    
                    <td width="20%">
                    <img width="200" height="200" src="/images/how_buy/shipping.png">
                    </td>
                    
                </tr>
                
                
                
                
                
                
                
                
                
                
                
              
                
            </tbody>
        </table>
        
        
        
        
        
        
        
        
        <?php if ($params->get('animate', '')): ?>
    </div>
<?php endif; ?>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('.no-touch .level-out').waypoint(function () {
                jQuery('.level-out').each(function () {
                    var num = jQuery(this).find('.level-in').attr('data-percent'),
                        percent = jQuery.animateNumber.numberStepFactories.append(' %');
                    jQuery(this).find('span').animateNumber({number: num, numberStep: percent}, num * 20);
                    jQuery(this).find('.level-in').css('left', -num + '%').css('width', num + '%');
                    jQuery(this).find('.level-in').animate({'left': '0%'}, num * 20);
                });
            }, {offset: '90%', triggerOnce: true});
            jQuery('.touch .level-out').each(function () {
                var num = jQuery(this).find('.level-in').attr('data-percent'),
                    percent = jQuery.animateNumber.numberStepFactories.append(' %');
                jQuery(this).find('span').animateNumber({number: num, numberStep: percent}, num * 20);
                jQuery(this).find('.level-in').css('left', -num + '%').css('width', num + '%');
                jQuery(this).find('.level-in').animate({'left': '0%'}, num * 20);
            });
        });

    </script>
<?php endif; ?>