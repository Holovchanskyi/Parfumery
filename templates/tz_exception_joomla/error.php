<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;

// Detecting Active Variables
$option = $app->input->getCmd('option', '');
$view = $app->input->getCmd('view', '');
$layout = $app->input->getCmd('layout', '');
$task = $app->input->getCmd('task', '');
$itemid = $app->input->getCmd('Itemid', '');
$sitename = $app->getCfg('sitename');
//var_dump($params);
if ($task == "edit" || $layout == "form") {
    $fullWidth = 1;
} else {
    $fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

// Add current user information
$user = JFactory::getUser();


// Logo file or site title param
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>"
      lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title><?php echo $this->title; ?> <?php echo htmlspecialchars($this->error->getMessage()); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    // Use of Google Font
    if ($params->get('googleFont')) {
        ?>
        <link href='//fonts.googleapis.com/css?family=<?php echo $params->get('googleFontName'); ?>' rel='stylesheet'
              type='text/css'/>
        <style type="text/css">
            h1, h2, h3, h4, h5, h6, .site-title {
                font-family: '<?php echo str_replace('+', ' ', $params->get('googleFontName'));?>', sans-serif;
            }
        </style>
    <?php
    }
    $theme = $params->get('theme', 'default');
    ?>
    <link rel="stylesheet"
          href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/themes/<?php echo $theme; ?>/template.css"
          type="text/css"/>

    <?php
    $debug = JFactory::getConfig()->get('debug_lang');
    if ((defined('JDEBUG') && JDEBUG) || $debug) {
        ?>
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/media/cms/css/debug.css" type="text/css"/>
    <?php
    }
    ?>
    <?php
    // If Right-to-Left
    if ($this->direction == 'rtl') {
        ?>
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/media/jui/css/bootstrap-rtl.css" type="text/css"/>
    <?php
    }
    ?>
    <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/favicon.ico" rel="shortcut icon"
          type="image/vnd.microsoft.icon"/>
    <?php
    // Template color
    if ($params->get('templateColor')) {
        ?>
        <style type="text/css">

            body.site {
                border-top: 3px solid <?php echo $params->get('templateColor');?>;
                background-color: <?php echo $params->get('templateBackgroundColor');?>
            }

            a {
                color: <?php echo $params->get('templateColor');?>;
            }

            .navbar-inner, .nav-list > .active > a, .nav-list > .active > a:hover, .dropdown-menu li > a:hover, .dropdown-menu .active > a, .dropdown-menu .active > a:hover, .nav-pills > .active > a, .nav-pills > .active > a:hover {
                background: <?php echo $params->get('templateColor');?>;
            }

            .navbar-inner {
                -moz-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
                -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
                box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
            }
        </style>
    <?php
    }
    ?>
    <!--[if lt IE 9]>
    <script src="<?php echo $this->baseurl ?>/media/jui/js/html5.js"></script>
    <![endif]-->
</head>

<body class="site <?php echo $option
    . ' view-' . $view
    . ($layout ? ' layout-' . $layout : ' no-layout')
    . ($task ? ' task-' . $task : ' no-task')
    . ($itemid ? ' itemid-' . $itemid : '')
    . ($params->get('fluidContainer') ? ' fluid' : '');
?>">

<!-- Body -->
<div class="body">
    <div class="container<?php echo($params->get('fluidContainer') ? '-fluid' : ''); ?>">
        <div class="row-fluid">
            <div id="content" class="span12">
                <div class="sectionWrapper">
                    <div class="container">
                        <div class="not-found">
                            <p class="hint extraLarge"><?php echo JText::_('TPL_EXEC_TITLE_EXTRA_404_LABEL'); ?></p>
                            <hr class="hr-style3">
                            <div class="err-404">
                                <?php
                                $code_error = str_split($this->error->getCode());
                                foreach ($code_error as $i => $code):
                                    echo ($i % 2 == 1) ? '<span class="main-color">' . $code . '</span>' : $code;
                                endforeach;
                                ?>
                            </div>
                            <hr class="hr-style3">
                            <p>
                                <?php echo $this->error->getMessage(); ?>
                            </p>
                            <a class="btn btn-medium"
                               href="./"><?php echo JText::_('TPL_EXEC_BACKHOME_404_LABEL') ?></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('.body').css('height', jQuery(document).height());
    });
</script>
</html>
