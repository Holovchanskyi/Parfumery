<?php


$doc = JFactory::getDocument();
$doc->addCustomTag('<script src="//vk.com/js/api/openapi.js?87"></script>');
if ($link==0){
	$linknone = 'display:none;';
	}
else {}
?>

<div  id="jlvkgroup<?php echo $group_id;?>"></div>
<script type="text/javascript">
VK.Widgets.Group("jlvkgroup<?php echo $group_id;?>", {mode: <?php echo $mode;?>, wide: <?php echo $wide;?>, width: "<?php echo $width;?>", height: "<?php echo $height;?>", color1: '<?php echo $color1;?>', color2: '<?php echo $color2;?>', color3: '<?php echo $color3;?>'}, <?php echo $group_id;?>);
</script>