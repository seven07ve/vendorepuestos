<?php // $Revision: 2.1.2.1 $

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


// This is by no means a complete list of all iso639-1 codes, but rather
// an unofficial list used by most browsers. If you have corrections or
// additions to this list, please send them to niels@creatype.nl

// German
// Corrections --> minichip@users.sourceforge.net

$phpAds_ISO639['af'] = 'Afrikaans';
$phpAds_ISO639['sq'] = 'Albanisch';
$phpAds_ISO639['eu'] = 'Baskisch';
$phpAds_ISO639['bg'] = 'Bulgarisch';
$phpAds_ISO639['be'] = 'Belorussisch';
$phpAds_ISO639['ca'] = 'Katalanisch';
$phpAds_ISO639['zh'] = 'Chinesisch';
$phpAds_ISO639['zh-cn'] = '- Chinesisch/China';
$phpAds_ISO639['zh-tw'] = '- Chinesisch/Taiwan';
$phpAds_ISO639['hr'] = 'Kroatisch';
$phpAds_ISO639['cs'] = 'Tschechisch';
$phpAds_ISO639['da'] = 'D�nisch';
$phpAds_ISO639['nl'] = 'Holl�ndisch';
$phpAds_ISO639['nl-be'] = '- Holl�ndisch/Belgien';
$phpAds_ISO639['en'] = 'Englisch';
$phpAds_ISO639['en-gb'] = '- Englisch/Gro�britannien';
$phpAds_ISO639['en-us'] = '- Englisch/Vereinigte Staaten';
$phpAds_ISO639['fo'] = 'Far�isch';
$phpAds_ISO639['fi'] = 'Finnisch';
$phpAds_ISO639['fr'] = 'Franz�sisch';
$phpAds_ISO639['fr-be'] = '- Franz�sisch/Belgien';
$phpAds_ISO639['fr-ca'] = '- Franz�sisch/Kanada';
$phpAds_ISO639['fr-fr'] = '- Franz�sisch/Frankreich';
$phpAds_ISO639['fr-ch'] = '- Franz�sisch/Schweiz';
$phpAds_ISO639['gl'] = 'Galizisch';
$phpAds_ISO639['de'] = 'Deutsch';
$phpAds_ISO639['de-au'] = '- Deutsch/�sterreich';
$phpAds_ISO639['de-de'] = '- Deutsch/Deutschland';
$phpAds_ISO639['de-ch'] = '- Deutsch/Schweiz';
$phpAds_ISO639['el'] = 'Griechisch';
$phpAds_ISO639['hu'] = 'Ungarisch';
$phpAds_ISO639['is'] = 'Isl�ndisch';
$phpAds_ISO639['id'] = 'Indonesisch';
$phpAds_ISO639['ga'] = 'Irisch';
$phpAds_ISO639['it'] = 'Italienisch';
$phpAds_ISO639['ja'] = 'Japanisch';
$phpAds_ISO639['ko'] = 'Koreanisch';
$phpAds_ISO639['mk'] = 'Mazedonisch';
$phpAds_ISO639['no'] = 'Norwegisch';
$phpAds_ISO639['pl'] = 'Polnisch';
$phpAds_ISO639['pt'] = 'Portugiesisch';
$phpAds_ISO639['pt-br'] = '- Portugiesisch/Brasilien';
$phpAds_ISO639['ro'] = 'Rum�nisch';
$phpAds_ISO639['ru'] = 'Russisch';
$phpAds_ISO639['gd'] = 'Schottisches G�lisch';
$phpAds_ISO639['sr'] = 'Serbisch';
$phpAds_ISO639['sk'] = 'Slowakisch';
$phpAds_ISO639['sl'] = 'Slowenisch';
$phpAds_ISO639['es'] = 'Spanisch';
$phpAds_ISO639['es-ar'] = '- Spanisch/Argentinien';
$phpAds_ISO639['es-co'] = '- Spanisch/Kolumbien';
$phpAds_ISO639['es-mx'] = '- Spanisch/Mexico';
$phpAds_ISO639['es-es'] = '- Spanisch/Spanien';
$phpAds_ISO639['sv'] = 'Schwedisch';
$phpAds_ISO639['tr'] = 'T�rkisch';
$phpAds_ISO639['uk'] = 'Ukrainisch'; 
$phpAds_ISO639['bs'] = 'Bosnisch';



// Load localized strings
if (file_exists(phpAds_path.'/language/'.$phpAds_config['language'].'/res-iso639.lang.php'))
	@include(phpAds_path.'/language/'.$phpAds_config['language'].'/res-iso639.lang.php');

?>