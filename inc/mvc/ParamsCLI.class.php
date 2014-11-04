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



if (!defined("XIMDEX_ROOT_PATH")) {
	define ("XIMDEX_ROOT_PATH", realpath(dirname(__FILE__). "/../../"));
}

require_once (XIMDEX_ROOT_PATH."/inc/cli/CliParser.class.php");

/**
 * 
 * @brief Define the list of allowed cli parameters
 *
 * List of allowed cli parameters, restrictions and messages sent to the interface
 */
class ParamsCLI extends CliParser  {
	/**
	 * 
	 * @var unknown_type
	 */
	var $_metadata = array (
		array ("name" => "--action",
				"mandatory" => true,
				"message" => "Nombre de la acci�n",
				"type" => TYPE_STRING),
		array ("name" => "--method",
				"mandatory" => true,
				"message" => "M�todo que se desea ejecutar",
				"type" => TYPE_STRING),
		array ("name" => "--renderer",
				"mandatory" => true,
				"message" => "Renderizador de plantillas",
				"type" => TYPE_STRING)
	);
}
?>