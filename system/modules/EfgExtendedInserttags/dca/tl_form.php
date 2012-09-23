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
$GLOBALS['TL_DCA']['tl_form']['fields']['extendedInserttagsActive'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_form']['extendedInserttagsActive'],
	'exclude'                 => true,
	'filter'                  => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('submitOnChange'=>true)
);

$GLOBALS['TL_DCA']['tl_form']['fields']['extendedInserttagsKey'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_form']['extendedInserttagsKey'],
	'exclude'                 => true,
	'filter'                  => false,
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>20, 'mandatory'=>true, 'rgxp'=>'alpha', 'nospace'=>true, 'unique'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_form']['fields']['extendedInserttagsIdField'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_form']['extendedInserttagsIdField'],
	'exclude'                 => true,
	'filter'                  => false,
	'inputType'               => 'select',
	'options_callback'        => array('EfgExtendedInserttags', 'getAllFormFields'),
	'eval'                    => array('mandatory'=>true, 'multiple'=>false, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_form']['fields']['extendedInserttagsFormParam'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_form']['extendedInserttagsFormParam'],
	'exclude'                 => true,
	'filter'                  => false,
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>20, 'mandatory'=>true, 'rgxp'=>'alpha', 'nospace'=>true, 'unique'=>true, 'tl_class'=>'w50')
);

// Palettes
$GLOBALS['TL_DCA']['tl_form']['palettes']['__selector__'][] = 'extendedInserttagsActive';

$GLOBALS['TL_DCA']['tl_form']['palettes']['default'] =  str_replace(array('{expert_legend:hide}'), array('{extended_inserttags_legend:hide},extendedInserttagsActive;{expert_legend:hide}'), $GLOBALS['TL_DCA']['tl_form']['palettes']['default'] );

// Subpalettes
array_insert($GLOBALS['TL_DCA']['tl_form']['subpalettes'], count($GLOBALS['TL_DCA']['tl_form']['subpalettes']),
	array('extendedInserttagsActive' => 'extendedInserttagsKey,extendedInserttagsIdField,extendedInserttagsFormParam')
);

?>