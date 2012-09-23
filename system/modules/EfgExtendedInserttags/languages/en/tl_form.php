<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>. 
 *
 * PHP version 5
 * @copyright  Cliff Parnitzky 2012
 * @author     Cliff Parnitzky
 * @package    EfgExtendedInserttags
 * @license    LGPL
 */

// fields
$GLOBALS['TL_LANG']['tl_form']['extendedInserttagsActive']    = array('Use extended insert tags', 'If you choose this option, extended insert tags could be used to get stored data (from database "Form data") of this form.');
$GLOBALS['TL_LANG']['tl_form']['extendedInserttagsKey']       = array('Insert tags key', 'Set the key, that will be used in the insert tags to identify this form.');
$GLOBALS['TL_LANG']['tl_form']['extendedInserttagsIdField']   = array('Field with record id', 'Select a field of this form, which value should be used to identify a unique data record of this form.');
$GLOBALS['TL_LANG']['tl_form']['extendedInserttagsFormParam'] = array('Form parameter name', 'Select the name of the form parameter, that contains the id.');

// legends
$GLOBALS['TL_LANG']['tl_form']['extended_inserttags_legend'] = "(EFG) Extended insert tags";
 
?>
