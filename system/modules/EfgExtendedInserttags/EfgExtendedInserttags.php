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

/**
 * Class EfgExtendedInserttags
 *
 * InsertTag hook class.
 * @copyright  Cliff Parnitzky 2012
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class EfgExtendedInserttags extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->import('Database');
		$this->import('Input');
	}
	
	/**
	 * Replaces the additional efg inserttags 
	 */
	public function replaceEfgExtendedInserttags($strTag)
	{
		$strTag = explode('::', $strTag);
		switch ($strTag[0])
		{
			case 'efgext':
				if (count($strTag) == 4 && strlen($strTag[1]) > 0 && strlen($strTag[2]) > 0 && strlen($strTag[3]) > 0) {
					$key = $strTag[1];
					$method = strtolower($strTag[2]) == 'post' ? 'post' : 'get';
					$fieldname = $strTag[3];
					
					$obForm = $this->Database->prepare("SELECT * FROM tl_form WHERE extendedInserttagsActive = ? AND extendedInserttagsKey = ?")
									   ->limit(1)
									   ->execute(array(1, $key));
					
					if ($obForm->numRows > 0) {
						$idField = $obForm->extendedInserttagsIdField;
						$idValue = $this->Input->$method($idField);
						
						$obRecord = $this->Database->prepare("SELECT * FROM tl_formdata_details WHERE ff_name = ? AND pid = (SELECT fdd.pid FROM tl_formdata_details fdd JOIN tl_formdata fd ON fdd.pid = fd.id WHERE fdd.value = ? AND fdd.ff_name = ? AND fd.form = ?)")
									   ->limit(1)
									   ->execute(array($fieldname, $idValue, $idField, $obForm->title));
						if ($obForm->numRows > 0) {
							$value = $obRecord->value;
							
							$dca = 'fd_' . str_replace('-', '_', standardize($obForm->title));
							
							if (strlen($obForm->formID)) {
								$dca = 'fd_' . $obForm->formID;
							}
							
							$this->loadDataContainer($dca);

							if ($GLOBALS['TL_DCA']['tl_formdata']['fields'][$fieldname]['inputType'] == 'password')
							{
								// do not allow extracting the password
								return "";
							}
							

							$value = deserialize($value);
							$rgxp = $GLOBALS['TL_DCA']['tl_formdata']['fields'][$fieldname]['eval']['rgxp'];
							$opts = $GLOBALS['TL_DCA']['tl_formdata']['fields'][$fieldname]['options'];
							$rfrc = $GLOBALS['TL_DCA']['tl_formdata']['fields'][$fieldname]['reference'];
							$fkey = $GLOBALS['TL_DCA']['tl_formdata']['fields'][$fieldname]['foreignKey'];

							$returnValue = '';
							if ($rgxp == 'date' || $rgxp == 'time' || $rgxp == 'datim')
							{
								$dateFormat = $GLOBALS['TL_CONFIG'][$rgxp . 'Format'];
								// check if custom format was set
								if (count($strTag) == 5 && strlen($strTag[4]) > 0) {
									$dateFormat = $strTag[4];
								}
								$returnValue = $this->parseDate($dateFormat, $value);
							}
							elseif (is_array($value))
							{
								$returnValue = implode(', ', $value);
								if (strlen($fkey) > 0)
								{
									$returnValue = $this->getArrayValueAsList($fkey, $returnValue);
								}
							}
							elseif (is_array($opts) && array_is_assoc($opts))
							{
								$returnValue = isset($opts[$value]) ? $opts[$value] : $value;
							}
							elseif (is_array($rfrc))
							{
								$returnValue = isset($rfrc[$value]) ? ((is_array($rfrc[$value])) ? $rfrc[$value][0] : $rfrc[$value]) : $value;
							}
							else
							{
								$returnValue = $value;
							}

							// Convert special characters (see #1890)
							return specialchars($returnValue);

						}
					}
				}
		}
		return false;
	}
	
	/**
	 * get all values of the given array
	 */
	private function getArrayValueAsList($foreignKey, $valueIds)
	{
		$foreignKey = explode('.', $foreignKey);
		$table = $foreignKey[0];
		$fieldname = $foreignKey[1];
		if (strlen($table) > 0 && strlen($valueIds) > 0)
		{
			$values = $this->Database->prepare("SELECT " . $fieldname . " FROM " . $table . " WHERE id IN (" . $valueIds . ") ORDER BY name ASC")
								->execute();
			$list = array();
			while ($values->next())
			{
				$list[] = $values->$fieldname;
			}
			return implode(", ", $list);
		}
		return "";
	}
	
	/**
	 * Return all possible form fields as array
	 * @return array
	 */
	public function getAllFormFields()
	{
		$fields = array('id'=>'ID');

		// Get all form fields which can be used
		$objFields = $this->Database->prepare("SELECT name,label FROM tl_form_field WHERE pid=? ORDER BY name ASC")
							->execute($this->Input->get('id'));

		while ($objFields->next())
		{
			$name = $objFields->name;
			$label = $objFields->label;

			if (strlen($name)) {
				$label = strlen($label) ? $label.' ['.$name.']' : $name;
				$fields[$name] = $label;
			}
		}

		return $fields;
	} 
}
?>