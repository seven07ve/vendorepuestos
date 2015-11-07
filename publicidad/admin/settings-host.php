<?php // $Revision: 3830 $

/************************************************************************/
/* Openads 2.0                                                          */
/* ===========                                                          */
/*                                                                      */
/* Copyright (c) 2000-2007 by the Openads developers                    */
/* For more information visit: http://www.openads.org                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/



// Include required files
include ("lib-settings.inc.php");


// Register input variables
phpAds_registerGlobal ('save_settings', 'reverse_lookup', 'proxy_lookup', 'geotracking_location', 'geotracking_type', 
					   'geotracking_cookie');


// Security check
phpAds_checkAccess(phpAds_Admin);


$errormessage = array();
$sql = array();

if (isset($save_settings) && $save_settings != '')
{
	phpAds_SettingsWriteAdd('reverse_lookup', isset($reverse_lookup));
	phpAds_SettingsWriteAdd('proxy_lookup', isset($proxy_lookup));
	
	if (isset($geotracking_type)) 
	{
		if ($geotracking_type == '0')
			$geotracking_type = '';
		
		if ($geotracking_type)
		{
			if (!file_exists(phpAds_path.'/libraries/geotargeting/geo-'.$geotracking_type.'.inc.php'))
				$errormessage[1][] = 'Unsupported plug-in';
			else
			{
				phpAds_SettingsWriteAdd('geotracking_type', $geotracking_type);

				if ($no_location = ($geotracking_type == 'mod_geoip'))
					$geotracking_location = '';

				if (isset($geotracking_location))
				{
					if (substr($geotracking_location, 0, 7) == 'http://')
					{
						$errormessage[1][] = str_replace('{example}', $_SERVER['DOCUMENT_ROOT'].'/Geo.dat', $strGeotrackingLocationNoHTTP);
					}
					elseif (!$no_location && !file_exists($geotracking_location))
						$errormessage[1][] = $strGeotrackingLocationError;
					else
					{
						@include_once (phpAds_path.'/libraries/geotargeting/geo-'.$geotracking_type.'.inc.php');
						
						if (function_exists('phpAds_'.$geotracking_type.'_getConf'))
						{
							$info = call_user_func('phpAds_'.$geotracking_type.'_getConf', $geotracking_location);
							
							if ($info === false)
								$errormessage[1] = $strGeotrackingUnsupportedDB;
						}
						else
							$info = '';
						
						phpAds_SettingsWriteAdd('geotracking_location', $geotracking_location);
						phpAds_SettingsWriteAdd('geotracking_conf', $info);
					}
				}
				else
				{
					phpAds_SettingsWriteAdd('geotracking_type', '');
					phpAds_SettingsWriteAdd('geotracking_location', '');
					phpAds_SettingsWriteAdd('geotracking_conf', '');
				}
			}
		}
		else
		{
			phpAds_SettingsWriteAdd('geotracking_type', '');
			phpAds_SettingsWriteAdd('geotracking_location', '');
			phpAds_SettingsWriteAdd('geotracking_conf', '');
		}
	}

	phpAds_SettingsWriteAdd('geotracking_cookie', isset($geotracking_cookie));
	
	
	
	if (!count($errormessage))
	{
		if (phpAds_SettingsWriteFlush())
		{
			header("Location: settings-stats.php");
			exit;
		}
	}
}



/*********************************************************/
/* HTML framework                                        */
/*********************************************************/

phpAds_PrepareHelp();
phpAds_PageHeader("5.1");
phpAds_ShowSections(array("5.1", "5.3", "5.4", "5.2"));
phpAds_SettingsSelection("host");



/*********************************************************/
/* Cache settings fields and get help HTML Code          */
/*********************************************************/

// Prepare geotargeting options
$geo_plugins = array();

$geo_plugin_dir = opendir(phpAds_path.'/libraries/geotargeting/');
while ($geo_plugin = readdir($geo_plugin_dir))
{
	if (preg_match('|geo-.*\.inc\.php|i', $geo_plugin) &&
		file_exists(phpAds_path.'/libraries/geotargeting/'.$geo_plugin))
	{
		include_once (phpAds_path.'/libraries/geotargeting/'.$geo_plugin);
		
		eval("$"."geo_plugin_info = phpAds_".$phpAds_geoPluginID."_getInfo();");

		$geo_plugins_info[$phpAds_geoPluginID] = $geo_plugin_info;
		$geo_plugins[$phpAds_geoPluginID] = $geo_plugin_info['name'];
	}
}

closedir($geo_plugin_dir);
asort($geo_plugins, SORT_STRING);


$i = 1;
$geo_plugins_sorted = array($strNone);
$geo_plugins_db = 'geotracking_type!=0';

while (list($k, $v) = each ($geo_plugins))
{
	$geo_plugins_sorted[$k] = $v;
	
	if (!$geo_plugins_info[$k]['db'])
		$geo_plugins_db .= ' && geotracking_type!='.$i;
	
	$i++;
}




$settings = array (

array (
	'text' 	  => $strRemoteHost,
	'items'	  => array (
		array (
			'type'    => 'checkbox',
			'name'    => 'reverse_lookup',
			'text'	  => $strReverseLookup
		),
		array (
			'type'    => 'break'
		),
		array (
			'type'    => 'checkbox',
			'name'    => 'proxy_lookup',
			'text'	  => $strProxyLookup
		)
	)
),
array (
	'text' 	  => $strGeotargeting,
	'items'	  => array (
		array (
			'type' 	  => 'select', 
			'name' 	  => 'geotracking_type',
			'text' 	  => $strGeotrackingType,
			'items'   => $geo_plugins_sorted
		),
		array (
			'type'    => 'break'
		),
		array (
			'type' 	  => 'text', 
			'name' 	  => 'geotracking_location',
			'text' 	  => $strGeotrackingLocation,
			'size'	  => 35,
			'depends' => $geo_plugins_db
		),
		array (
			'type'    => 'break'
		),
		array (
			'type'    => 'checkbox',
			'name'    => 'geotracking_cookie',
			'text'	  => $strGeoStoreCookie,
			'depends' => 'geotracking_type>0'
		)
	)
));



/*********************************************************/
/* Main code                                             */
/*********************************************************/

phpAds_ShowSettings($settings, $errormessage);



/*********************************************************/
/* HTML framework                                        */
/*********************************************************/

phpAds_PageFooter();

?>