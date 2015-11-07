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
require ("config.php");
require ("lib-statistics.inc.php");


// Register input variables
phpAds_registerGlobal ('plugin', 'delimiter', 'quotes');


if (isset($plugin) && $plugin != '')
{
	$filename = 'report-plugins/'.$plugin.'.plugin.php';
	
	if (file_exists($filename))
	{
		include ($filename);
		$plugininfo = $plugin_info_function();
		
		// Check security
		phpAds_checkAccess($plugininfo["plugin-authorize"]);
		
		$plugin_execute_function = $plugininfo["plugin-execute"];
		$plugin_import 			 = $plugininfo["plugin-import"];
		$plugin_variables		 = array();
		
		foreach (array_keys($plugin_import) as $key)
		{
			// Register needed plugin variables
			phpAds_registerGlobal ($key);
			
			if (isset($$key) && $$key != '')
				$plugin_variables[] = "'".addslashes($$key)."'";
			else
				$plugin_variables[] = "''";
		}
		
		$executestring = $plugin_execute_function."(".implode(",", $plugin_variables).");";
		@eval ($executestring);
	}
}

?>