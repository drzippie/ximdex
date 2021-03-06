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
 *
 */
class Appender {
	/**
	 * 
	 * @var unknown_type
	 */
	var $_layout;
	/**
	 * 
	 * @var unknown_type
	 */
	var $_msg;

	/**
	 * Recibe como parametro un array asociativo en el que cada elemento es un parametro de configuracion.
	 * Cada descendendiente de Appender debe conocer que parametros obtener del array.
	 */
	function Appender( &$params ) {

		$this->_layout =& $params['layout'];
	}
	/**
	 * 
	 * @param $layout
	 * @return unknown_type
	 */
	function setLayout(&$layout) {

		$this->_layout =& $layout;
	}
	/**
	 * 
	 * @return unknown_type
	 */
	function & getLayout() {

		return $this->_layout;
	}
	/**
	 * 
	 * @param $event
	 * @return unknown_type
	 */
	function write(&$event) {

		$layout =& $this->getLayout();
		$this->_msg = $layout->format($event);
	}
}
?>