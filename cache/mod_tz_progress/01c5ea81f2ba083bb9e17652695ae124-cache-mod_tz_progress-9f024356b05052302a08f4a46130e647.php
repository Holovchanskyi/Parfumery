<?php die("Access Denied"); ?>#x#a:2:{s:6:"output";a:3:{s:4:"body";s:0:"";s:4:"head";a:0:{}s:13:"mime_encoding";s:9:"text/html";}s:6:"result";s:4942:"<div class="tz-module module " id="Mod235"><div class="module-inner"><h3 class="module-title center block-head">Как совершить покупку у нас?</h3><div class="module-ct">        <div class="fx" data-animate="fadeInLeft">
                  
        
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
        
        
        
        
        
        
        
        
            </div>
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
</div></div></div>";}