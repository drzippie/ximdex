{**
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
 *}

<form method="post" name="cln_form" id="cln_form" action="{$action_url}">
	<input type="hidden" name="id_node" value="{$id_node}" >
	<div class="action_header">
		<h2>{t}Create link{/t}</h2>
		<fieldset class="buttons-form">
		{button label="Create" class='validate btn main_action'} <!--message="Would you like to create a new link?"-->
	</fieldset>
	</div>
	<div class="action_content">
		<fieldset>
			<ol>
				<li>
					<label for="name" class="aligned"><span>{t}Name{/t}</span></label>
					<input type="text" name="name" id="name" class="cajaxg validable not_empty"/>
				</li>
				<li>
					<label for="url" class="aligned"><span>{t}URL{/t}</span></label>
					<input type="text" name="url" id="url" class="cajaxg validable not_empty is_url">
				</li>
				<li>
		                                <label class="aligned"><span>{t}Prefixes{/t}</span></label>
		                                <input type="checkbox" name="urlprefix" id="urlprefix" class="">
		                                <label for="prefix" class=""><span>{t}Add{/t} <i>http://</i></span></label>
		                                <input type="checkbox" name="mailprefix" id="mailprefix" class="">
		                                <label for="mailprefix" class=""><span>{t}Add{/t} <i>mailto:</i></span></label>
		                        </li>
				<li>
					<label for="description" class="aligned"><span>{t}Description{/t}</span></label>
					<input type="text" name="description" id="description" class="cajaxg validable not_empty">
				</li>
			</ol>
		</fieldset>
	</div>
</form>
