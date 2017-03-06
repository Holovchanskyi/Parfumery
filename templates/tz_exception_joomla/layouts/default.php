<?php
/**
 *
 * Plazart framework layout
 *
 * @version             1.0.0
 * @package             Plazart Framework
 * @copyright            Copyright (C) 2012 - 2013 TemPlaza. All rights reserved.
 *
 */

// no direct access
defined('_JEXEC') or die;
?>
    <!DOCTYPE html>
    <html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>"
          class="<?php $this->bodyClass(); ?>">
    <head>
        <jdoc:include type="head"/>
        <?php $this->loadBlock('head'); ?>
    </head>

    <body<?php if ($this->browser->get("tablet") == true) echo ' data-tablet="true"'; ?><?php if ($this->browser->get("mobile") == true) echo ' data-mobile="true"'; ?>
        class="<?php echo $this->bodyClass() ?>">
    <?php $position = 'loading';
    $contents = '';
    foreach (JModuleHelper::getModules($position) as $mod) {
        $contents .= JModuleHelper::renderModule($mod);
    }
    echo $contents;
    ?>
    <?php if ($this->getParam('boxes_temp') == 1): ?>
    <div class="pageWrapper fixedPage">
        <?php endif; ?>

        <?php
        if ($this->getParam('layout_enable', 1)) {
            $this->layout();
        } else {
            $this->loadBlock('body');
        }
        $this->loadBlock('utilities');
        ?>
        <?php if ($this->getParam('boxes_temp') == 1): ?>
    </div>
    <?php endif; ?>
    </body>
    </html>
<?php
TZRules::setRule('/<link rel="stylesheet" href="(.*?)\/media\/com_uniterevolution2\/assets\/rs-plugin\/css\/settings.css".*?\/>/mi', '');
TZRules::setRule('/<link rel="stylesheet" href="(.*?)\/components\/com_xmap\/assets\/css\/xmap.css".*?\/>/mi', '');
?>