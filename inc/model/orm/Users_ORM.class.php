<?php
/**
 *  \details &copy; 2011  Open Ximdex Evolution SL [http://www.ximdex.org]
 *
 *  Ximdex a Semantic Content Management System (CMS)
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published
 *  by the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  See the Affero GNU General Public License for more details.
 *  You should have received a copy of the Affero GNU General Public License
 *  version 3 along with Ximdex (see LICENSE file).
 *
 *  If not, visit http://gnu.org/licenses/agpl-3.0.html.
 *
 *  @author Ximdex DevTeam <dev@ximdex.com>
 *  @version $Revision$
 */



/**
 * XIMDEX_ROOT_PATH
 */
if (!defined('XIMDEX_ROOT_PATH'))
	define('XIMDEX_ROOT_PATH', realpath(dirname(__FILE__) . '/../../../'));

include_once (XIMDEX_ROOT_PATH . '/inc/helper/GenericData.class.php');

class Users_ORM extends GenericData   {
	var $_idField = 'IdUser';
	var $_table = 'Users';
	var $_metaData = array(
				'IdUser' => array('type' => "int(12)", 'not_null' => 'true', 'primary_key' => true),
				'Login' => array('type' => "varchar(255)", 'not_null' => 'true'),
				'Pass' => array('type' => "varchar(255)", 'not_null' => 'true'),
				'Name' => array('type' => "varchar(255)", 'not_null' => 'true'),
				'Email' => array('type' => "varchar(255)", 'not_null' => 'true'),
				'Locale' => array('type' => "varchar(5)", 'not_null' => 'false'),
				'LastLogin' => array('type' => "int(14)", 'not_null' => 'false'),
				'NumAccess' => array('type' => "int(12)", 'not_null' => 'false')
				);
	var $_uniqueConstraints = array(
				'login' => array('Login')
				);
	var $_indexes = array('IdUser');
	var $IdUser;
	var $Login = 0;
	var $Pass = 0;
	var $Name = 0;
	var $Email;
	var $Locale;
	var $LastLogin;
	var $NumAccess;
}
?>
