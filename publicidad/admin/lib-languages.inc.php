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



/*********************************************************/
/* Returns available languages as array                  */
/*********************************************************/

function phpAds_AvailableLanguages()
{
	$languages = array();
	
	$langdir = opendir(phpAds_path.'/language/');
	while ($langfile = readdir($langdir))
	{
		if ($langfile{0} == '.')
				continue;
		
		if (is_dir(phpAds_path.'/language/'.$langfile) &&
			file_exists(phpAds_path.'/language/'.$langfile.'/index.lang.php'))
		{
			@include(phpAds_path.'/language/'.$langfile.'/index.lang.php');
			$languages[$langfile] = $translation_readable;
		}
	}
	closedir($langdir);
	asort($languages, SORT_STRING);
	
	return $languages;
}

?>