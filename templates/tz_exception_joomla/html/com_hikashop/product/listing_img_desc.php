<?php
/**
 * @package	HikaShop for Joomla!
 * @version	2.3.3
 * @author	hikashop.com
 * @copyright	(C) 2010-2014 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><?php
$height = $this->newSizes->height;
$width = $this->newSizes->width;
$link = hikashop_contentLink('product&task=show&cid='.$this->row->product_id.'&name='.$this->row->alias.$this->itemid.$this->category_pathway,$this->row);

if(!empty($this->row->extraData->top)) { echo implode("\r\n",$this->row->extraData->top); }
?>
<table>
    <thead>
		
        <tr>
            <th class="prod_listing_head_style">
                <h2 >
				<!-- PRODUCT NAME -->
					<span class="prod_listing_head_style hikashop_product_name">
						<?php if($this->params->get('link_to_product_page',1)){ ?>
							<a class="prod_listing_head_style" href="<?php echo $link;?>">
						<?php } ?>
								<?php
								echo $this->row->product_name;
								?>
						<?php if($this->params->get('link_to_product_page',1)){ ?>
							</a>
						<?php } ?>
					</span>
				<!-- EO PRODUCT NAME -->

				<!-- PRODUCT CODE -->
					<span class='hikashop_product_code_list'>
						<?php if ($this->config->get('show_code')) { ?>
							<?php if($this->params->get('link_to_product_page',1)){ ?>
								<a href="<?php echo $link;?>">
							<?php }
							echo $this->row->product_code;
							if($this->params->get('link_to_product_page',1)){ ?>
								</a>
							<?php } ?>
						<?php } ?>
					</span>
				<!-- EO PRODUCT CODE -->
				</h2>

				<?php if(!empty($this->row->extraData->afterProductName)) { echo implode("\r\n",$this->row->extraData->afterProductName); } ?>
            </th>
        </tr>
		
    </thead>


    <tbody>
        <tr>
            <td class="prod_listing_img">
            <!-- PRODUCT IMG -->
				<?php if($this->config->get('thumbnail',1)){ ?>
				<div style="height:<?php echo $this->image->main_thumbnail_y;?>px;text-align:center;clear:both;" class="hikashop_product_image">
					<div style="position:relative;text-align:center;clear:both;width:<?php echo $this->image->main_thumbnail_x;?>px;margin: auto;" class="hikashop_product_image_subdiv">
					<?php if($this->params->get('link_to_product_page',1)){ ?>
						<a href="<?php echo $link;?>" title="<?php echo $this->escape($this->row->product_name); ?>">
					<?php }
						$image_options = array('default' => true,'forcesize'=>$this->config->get('image_force_size',true),'scale'=>$this->config->get('image_scale_mode','inside'));
						$img = $this->image->getThumbnail(@$this->row->file_path, array('width' => $this->image->main_thumbnail_x, 'height' => $this->image->main_thumbnail_y), $image_options);
						if($img->success) {
							echo '<img class="hikashop_product_listing_image" title="'.$this->escape(@$this->row->file_description).'" alt="'.$this->escape(@$this->row->file_name).'" src="'.$img->url.'"/>';
						}
						$main_thumb_x = $this->image->main_thumbnail_x;
						$main_thumb_y = $this->image->main_thumbnail_y;
						if($this->params->get('display_badges',1)){
							$this->classbadge->placeBadges($this->image, $this->row->badges, -10, 0);
						}
						$this->image->main_thumbnail_x = $main_thumb_x;
						$this->image->main_thumbnail_y = $main_thumb_y;

					if($this->params->get('link_to_product_page',1)){ ?>
						</a>
					<?php } ?>
					</div>
				</div>
				<!-- EO PRODUCT IMG -->
            </td>
        </tr>

        



        <tr>
            <td>
                <!-- PRODUCT PRICE -->
				<?php
				}
				if($this->params->get('show_price','-1')=='-1'){
					$config =& hikashop_config();
					$this->params->set('show_price',$config->get('show_price'));
				}
				if($this->params->get('show_price')){
					$this->setLayout('listing_price');
					echo $this->loadTemplate();
				}
				?>
				<!-- EO PRODUCT PRICE -->
            </td>
        </tr>
    </tbody>

    <tfoot>
        <tr>
            <td class="prod_add_to_cart_btn">
                <!-- ADD TO CART BUTTON AREA -->
				<?php
				if($this->params->get('add_to_cart') || $this->params->get('add_to_wishlist')){
					$this->setLayout('add_to_cart_listing');
					echo $this->loadTemplate();
				} ?>
				<!-- EO ADD TO CART BUTTON AREA -->
            </td>
        </tr>
    </tfoot>

</table>
<?php if(!empty($this->row->extraData->bottom)) { echo implode("\r\n",$this->row->extraData->bottom); } ?>