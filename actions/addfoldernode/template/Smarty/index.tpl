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

<form method="post" id="print_form" action="{$action_url}">
	<div class="action_header">
		<h2>{t}Add{/t} {$friendlyName|gettext}</h2>
	</div>
	<div class="action_content">
		<p class="icon icon-positioned server input">
			<input type="text" name="name" id="foldername" class="cajaxg validable js_val_alphanumeric not_empty full-size {$friendlyName|replace:" ":"_"}_icon" placeholder="{t}{$friendlyName} name{/t}">
		</p>
	</div>
	<fieldset class="buttons-form positioned_btn">
	    {button label="Create" class='validate btn main_action'}
	</fieldset>	
</form>
