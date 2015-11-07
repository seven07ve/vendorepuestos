<?php
/*********************************************************************************
* Script......... : class BiffWriter - extends BiffBase                          *
* Author......... : Christian Novak - cnovak@gmx.net                             *
* Copyright...... : (c) 2001, 2002 Christian Novak                               *
* Documentation.. : http://www.cnovak.com                                        *
* History........ : rev 3.1 Cyrillic support added, julianjtd function added     *
*                   rev 3.0 (20020517) added xlsFreeze, xlsSetRow and xlsWindow  *
*                   rev 2.1 added xlsWriteDateTime to write an SQL datetime      *
*                   stamp as an Excel float                                      *
*                 : rev 2.0 introduces "A1" standard spread sheet notation.      *
*                       Please read the manual "biffmanual.htm" available at     *
*                       http//:www.cnovak.com                                    *
* Requires        : PHP 4 >= 4.0.5                                               *
*                                                                                *
*                                                                                *
* This class extends BiffWriter by adding type and parameter checking            *
* where applicable and reasonable. It is recommended to use this class           *
* for smaller files < 1000 cells and during the debugging phase.                 *
*                                                                                *
* All functions taking a row, col argument can be now called in 2 ways:          *
*                                                                                *
*   xlsWriteText('B2', 0, 'mytext') or xlsWriteText(3, 2, 'mytext');             *
*                                                                                *
* when using the A1 notation instead of the row, column notation, the            *
* second argument must always contain something.                                 *
**********************************************************************************
*     This library is distributed in the hope that it will be useful, but        *
*   WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY   *
*                  or FITNESS FOR A PARTICULAR PURPOSE.                          *
*                                                                                *
*         This library is copyright (c) by Christian Novak and is only           *
*                _FREE_ for _NON_ _COMMERCIAL_ purposes                          *
*                                                                                *
*  Please carefully read "license_agreement.htm" part of this package prior of   *
*                            using BiffWriter                                    * 
*                                                                                *
*     Please contact me at cnovak@gmx.net if you plan to use biffwriter          *
*           in an Intranet or commercial Internet application                    *
**********************************************************************************
* $Id: biff.php,v 1.3 2002/07/27 19:59:28 cnovak Exp $
*/
require_once("biffbase.php");

class BiffWriter extends BiffBase
{
	var $a_not = array();
		
	function BiffWriter()
	{
		error_reporting (E_ALL);
		parent::BiffBase();					// initialize base class
		$this->_fill_AA_notation();			// create an array holding AA..AZ notation
	}
	

	function xlsWindow($grid = TRUE, $ref = TRUE, $zero = TRUE)
	{
		parent::xlsWindow($grid, $ref, $zero);
	}

	function xlsSetRow($row, $height) 
	{
		if ($row < 0) {
			trigger_error('xlsSetRow() - row value must be positive integers', E_USER_ERROR);			 
		}
		if (!is_int($row))  {
			trigger_error('xlsSetRow() - row value must be integer', E_USER_ERROR);
		}
		if ($row > MAX_ROWS) { 
			trigger_error('xlsSetRow() - ' . MAX_ROWS. ' rows max', E_USER_ERROR); 
		}
		parent::xlsSetRow($row, $height);
	}

	function xlsFreeze()
	{
		if (func_num_args() === 2) {
		    $row = func_get_arg(0);
			$col = func_get_arg(1);
		}
		if (func_num_args() === 1) {
			$val = func_get_arg(0);
			if (is_string($val)) {
				$col = preg_match('/[a-zA-Z]/', $val) ? $this->_cnv_AA_to_col($val) : 0;
				$row = preg_match('/[0-9]/', $val) ? $this->_cnv_AA_to_row($val) : 0;
			}
			if (is_int($val)) {
			    $col = 0;
				$row = $val;
			}
		}
		$this->check_bounds($row, $col, 'line '. __line__ .' xlsFreeze');		    
		parent::xlsFreeze($row, $col);
	}


	function xlsParse($file = '')
	{	
		$file = parent::xlsParse($file);
		return($file);
	} // end func


	function xlsAddHPageBreak($row) 
	{
		if ($row < 0 or $row > MAX_ROWS or !is_int($row)) {
			trigger_error('xlsAddHPagebreak: row must be a positive integer from 0 to ' . MAX_ROWS, E_USER_ERROR);			 
		}
		parent::xlsAddHPageBreak($row);
	}
	
	function xlsAddVPageBreak($col) 
	{

		if (is_string($col)) {
			$col = (int) $this->_cnv_AA_to_col($col);
		}
		if ($col < 0 or $col > MAX_COLS) {
			trigger_error('xlsAddVPagebreak: column must be a positive integer from 0 to ' . MAX_COLS, E_USER_ERROR);			 
		}

		parent::xlsAddVPageBreak($col);
	}


	function xlsSetColWidth($col_start, $col_end, $width) 
	{
		if (is_string($col_start)) {
			$col_start = (int) $this->_cnv_AA_to_col($col_start);			 
		}
		if (is_string($col_end)) {
			$col_end = (int) $this->_cnv_AA_to_col($col_end);			 
		}
			if (!is_int($col_start) | !is_int($col_end)) {
			trigger_error('xlsSetColWidth 1. and 2. parameter must be positve integers', E_USER_ERROR);
		}
		if ($col_start < 0 or $col_end < 0) {
			trigger_error('xlsSetColWidth columns must be positive integers', E_USER_ERROR);			 
		}
		if ($col_start > MAX_COLS or $col_end > MAX_COLS) { 
			trigger_error('xlsSetColWidth ' . MAX_COLS. ' cols max', E_USER_ERROR); 
		}
		if (!is_int($width) or $width > 255 or $width < 0) {
			trigger_error('xlsSetColWidth width must be an integer in the range of 0-255!', E_USER_ERROR); 
		}
		parent::xlsSetColWidth($col_start, $col_end, $width);
	}


	function xlsWriteDateTime($row, $col, $value, $col_width = 0, $cell_picture = 0, $cell_font = 0, $cell_alignment = ALIGN_RIGHT, $cell_status = 0) 
	{
		$this->check_bounds($row, $col, 'line '. __line__ .' xlsWriteNumber');
		if (!is_string($value)) {
			trigger_error('xlsWriteDateTime 3. parameter must be string', E_USER_ERROR);
		}
		parent::xlsWriteDateTime($row, $col, $value, $col_width, $cell_picture, $cell_font, $cell_alignment, $cell_status );
	}


	function xlsWriteNumber($row, $col, $value, $col_width = 0, $cell_picture = 0, $cell_font = 0, $cell_alignment = ALIGN_RIGHT, $cell_status = 0) 
	{
		$this->check_bounds($row, $col, 'line '. __line__ .' xlsWriteNumber');
		if (!is_int($value) & !is_float($value)) {
			trigger_error('xlsWriteNumber 3. parameter must be either int or float', E_USER_ERROR);
		}
		parent::xlsWriteNumber($row, $col, $value, $col_width, $cell_picture, $cell_font, $cell_alignment, $cell_status );
	}


	function xlsWriteText($row, $col, $value, $col_width = 0, $cell_picture = 0, $cell_font = 0, $cell_alignment = ALIGN_GENERAL, $cell_status = 0) 
	{
		$this->check_bounds($row, $col, 'line '. __line__ .' xlsWriteText');
		if (!is_string($value)) { 
			trigger_error('xlsWriteText 3. parameter must be string!', E_USER_ERROR); 
		}
		if (strlen($value) > MAX_TEXT_CHARS) { 
			trigger_error($ref .MAX_TEXT_CHARS. ' chars max', E_USER_ERROR); 
		}
		parent::xlsWriteText($row, $col, $value, $col_width, $cell_picture, $cell_font, $cell_alignment, $cell_status);
	}


	function xlsCellNote($row, $col, $value) 
	{  
		$this->check_bounds($row, $col, 'line '. __line__ .' xlsCellNotes');
		if (strlen($value) > MAX_NOTE_CHARS) { 
			trigger_error($ref .MAX_NOTE_CHARS. ' chars max', E_USER_ERROR); 
		}
		parent::xlsCellNote($row, $col, $value);
	}

	/*
	** This function does boundary checking on row and column values.
	** It tries first to check if the supplied argument was in A1 notation,
	** if this fails it looks for the faster row, col notation.
	*/
	function check_bounds(&$row, &$col, $ref) {
		if (is_string($row)) {
			$col = (int) $this->_cnv_AA_to_col(func_get_arg(0));
			$row = (int) $this->_cnv_AA_to_row(func_get_arg(0));
		}
		if ($row < 0 or $col < 0) {
			trigger_error($ref . ' rows or columns must be positive integers', E_USER_ERROR);			 
		}
		if (!is_int($row) or ! is_int($col))  {
			trigger_error($ref . ' rows or columns must be integers', E_USER_ERROR);
		}
		if ($row > MAX_ROWS) { 
			trigger_error($ref . MAX_ROWS. ' rows max', E_USER_ERROR); 
		}
		if ($col > MAX_COLS) { 
			trigger_error($ref . MAX_COLS. ' cols max', E_USER_ERROR); 
		}
	} // end func

	/*
	** This function extracts the column number from an
	** A1 notation. It returns -1 if the passed arguments 
	** is wrong or if value exceeds IV = 255 columns
	*/
	function _cnv_AA_to_col($val)
	{
		$res = NULL;
		$col = preg_split('/[0-9]/', $val, -1, PREG_SPLIT_NO_EMPTY);
		if (!empty($col)) {
			$res = array_search(strtoupper($col[0]), $this->a_not, TRUE);
			if (is_null($res)) {
				return(-1);
			}
			else {
				return($res);
			}
		}
		else {
			return(-1);								 // preg_split failed
		}
	} // end func


	/*
	** This function extracts the row value from the A1 notation.
	** It returns -1 if the regular expression fails
	*/
	function _cnv_AA_to_row($val)
	{
		$row = preg_split('/[a-zA-Z]/', $val, -1, PREG_SPLIT_NO_EMPTY);
		if (!empty($row)) {
			return($row[0]-1);
		}
		else {
			return(-1); 
		}
	} // end func

	/*
	** this function fills the A1 notation array
	*/
	function _fill_AA_notation()
	{
		$max = 256;
		$start = 65;
		$end = 90;
		$y = $start;
		$z = $start;
		$pre = NULL;
		for ($x = 1; $x <= $max; $x++) {
			if ($z <> $start) {
				 $pre = chr($z-1);
			}
			$this->a_not[] = $pre . chr($y);
			if ($y == $end) {
				$y = $start-1;
				$z++;
			}
			$y++;
		}

	} // end func

} // end class
/*
** IMPORTANT!!!!
** Make sure that there is no additional line below the tag!
** Otherwise your stream will not work since the server will send 
** a header encountering anything outside of <?php ... >"
** "include" seems not to care about this, but gives no warning 
** if the include fails!
*/
?>