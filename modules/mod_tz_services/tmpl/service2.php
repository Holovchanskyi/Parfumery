<?php
/*------------------------------------------------------------------------

# ------------------------------------------------------------------------

# author    TuanNATemplaza

# copyright Copyright (C) 2012-2013 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

//no direct access
defined('_JEXEC') or die();
$doc = JFactory::getDocument();
?>
<?php if ($list): ?>
    <div class="row padd-top-25">      
	<?php foreach ($list as $item): ?>
		<div class="cell-3 service-box-2 fx" data-animate="fadeInDown"
			 data-animation-delay="<?php echo $item->delay_animation; ?>">
			<div class="box-2-cont">
				<i class="<?php echo $item->icon; ?>"></i>
				<h4><?php echo $item->title; ?></h4>

				<div class="center sub-title main-color"><?php echo $item->sub_title; ?></div>
				<?php echo $item->content; ?>
				<a class="r-more main-color" href="<?php echo $item->link; ?>">
					<?php echo JText::_('READ_MORE_SERVICES_2') ?>
				</a>
			</div>
		</div>
	<?php endforeach; ?>       
    </div>  
<?php endif; ?>