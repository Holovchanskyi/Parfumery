<?php
//error_reporting(0);

jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.archive');
jimport('joomla.filesystem.path');
jimport('joomla.error.error');

class Pkg_ukUAInstallerScript
{

	protected $message;
	protected $status;
	protected $sourcePath;

	public function preflight($type, $parent)
	{
        if(version_compare( JVERSION, '3.0.0', '<') == 1) {
            JError::raiseNotice(null, 'Ця версія української локалізації призначена для Joomla 3.x і не підтримується на Joomla 2.5! Будь-ласка, завантажте коректну локалізацію для вашої версії Joomla! за адресою: <a href="http://joomla-ua.org/localization" target="_blank">http://joomla-ua.org/localization</a>');

            return false;
        }

		return true;
	}

	public function uninstall($parent)
	{
        return true;
	}

	public function update($parent)
	{
        return true;
	}

	public function postflight($type, $parent, $results)
	{
        $db         = JFactory::getDbo();
		$query      = $db->getQuery(true);

        $adm_path	= str_replace(array('/administrator', '\administrator'), '', JPATH_BASE);

        $installer	= JInstaller::getInstance();
        $manifest	= $installer->getManifest();
        $sourcePath	= $installer->getPath('source');

		$db->setQuery("DELETE FROM `#__extensions` WHERE `element` = 'pkg_ukUA'");
		$db->query();

        $jun = $db->getQuery(true);
        $jun = "UPDATE `#__modules` SET `position` = 'cpanel', `published` = 1, `showtitle` = 0, `ordering` = 99 WHERE `module` = 'mod_junews' AND `client_id` = 1";
        $db->setQuery( $jun );
        $db->query();

        $jun1 = $db->getQuery(true);
        $jun1 = "INSERT INTO #__modules_menu (moduleid, menuid) SELECT #__modules.id, 0 FROM #__modules WHERE #__modules.module = 'mod_junews' AND #__modules.position = 'cpanel' AND NOT EXISTS (SELECT 1 FROM #__modules_menu WHERE moduleid = #__modules.id) ORDER BY id DESC LIMIT 1";
        $db->setQuery( $jun1 );
        $db->query();

		if(is_dir(JPATH_BASE .'/modules/mod_jumenu'))
		{
	        $junews1 = $db->getQuery(true);
	        $junews1 = "DELETE FROM `#__modules` WHERE `module` = 'mod_jumenu'";
	        $db->setQuery($junews1);
	        $db->query();

	        $junews2 = $db->getQuery(true);
	        $junews2 = "DELETE FROM `#__extensions` WHERE `element` = 'mod_jumenu'";
	        $db->setQuery($junews2);
	        $db->query();

		   	Pkg_ukUAInstallerScript::unlinkRecursive(JPATH_BASE .'/modules/mod_jumenu/', 1);
		}


        $manifestua = $adm_path .'/administrator/manifests/packages/pkg_ukUA.xml';
		if (file_exists($manifestua)) {
        	unlink($manifestua);
		}

		if(is_dir(JPATH_BASE .'/manifests/packages/ukUA')) {
		   	Pkg_ukUAInstallerScript::unlinkRecursive(JPATH_BASE .'/manifests/packages/ukUA/', 0);
		}
		return true;
	}

    public function unlinkRecursive($dir, $deleteRootToo)
    {
        if(!$dh = @opendir($dir)) {
            return;
        }

        while (false !== ($obj = readdir($dh)))
        {
            if($obj == '.' || $obj == '..') {
                continue;
            }
            if (!@unlink($dir . '/' . $obj)) {
                Pkg_ukUAInstallerScript::unlinkRecursive($dir.'/'.$obj, true);
            }
        }
        closedir($dh);

        if ($deleteRootToo == 1) {
            @rmdir($dir);
        }
        return;
    }
}