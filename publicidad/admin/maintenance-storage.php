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
require ("lib-maintenance.inc.php");
require ("lib-statistics.inc.php");
require ("lib-zones.inc.php");


// Security check
phpAds_checkAccess(phpAds_Admin);



/*********************************************************/
/* HTML framework                                        */
/*********************************************************/

phpAds_PageHeader("5.3");
phpAds_ShowSections(array("5.1", "5.3", "5.4", "5.2"));
phpAds_MaintenanceSelection("storage");


/*********************************************************/
/* Main code                                             */
/*********************************************************/

echo "<br>";
echo $strStorageExplaination;
echo "<br><br>";

phpAds_ShowBreak();
echo "<img src='images/".$phpAds_TextDirection."/icon-undo.gif' border='0' align='absmiddle'>&nbsp;<a href='maintenance-storage-move.php'>$strMoveToDirectory</a>&nbsp;&nbsp;";
phpAds_ShowBreak();



/*********************************************************/
/* HTML framework                                        */
/*********************************************************/

phpAds_PageFooter();

?>