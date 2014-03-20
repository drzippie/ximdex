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

<div id="%=id%" class="browser-window %=class%">
	<div class="browser-window-content">
		
		<div id="angular-tree" class="angular-panel hbox-panel-container-0">
			<tabset class="ui-tabs ui-widget ui-widget-content ui-corner-all tabs-container">
				<tab heading="projects">
					<script type="text/ng-template"  id="tree_item_renderer.html">
					    <div ng-class="{literal}{'xim-treeview-container-selected': selectednode.id == node.id}{/literal}">
					    	<span class="ui-icon xim-actions-toggle-node" ng-class="{literal}{'ui-icon-triangle-1-se': node.showNodes, 'ui-icon-triangle-1-e': !node.showNodes, 'icon-hidden': !node.children}{/literal}" ng-click="toggleNode(node)"></span>
					    	<span class="xim-treeview-icon icon-#/nodetypes[node.nodetypeid].name/#" ng-click="loadActions(node)"></span>
					    	<span class="xim-treeview-branch" ng-click="selectNode(node, $event)">#/node.name/#</div>
					    </div>
					    <ul class="xim-treeview-branch" ng-show="node.showNodes">
					        <li ng-repeat="node in node.collection" ng-include="'tree_item_renderer.html'" class="xim-treeview-node"></li>
					    </ul>
					    <ul class="xim-treeview-loading" id="treeloading-undefined" ng-show="node.showNodes && node.loading"><li></li><img src="http://localhost/xdx/actions/browser3/resources/images/loading.gif"></ul>
					</script>
					<ul ng-controller="XTreeCtrl" class="angular-tree xim-treeview-branch">
					    <li ng-repeat="node in tree.collection" ng-include="'tree_item_renderer.html'" class="xim-treeview-node"></li>
					</ul>
				</tab>
				<tab heading="ccenter">Contenido dos de la muerte</tab>
				<tab heading="modules">Contenido tres del tardon</tab>
			</tabset>
		</div>
		
		<div id="angular-content" class="angular-panel">
			<div class="test-box"></div>
		</div>
		
		<div id="angular-tree-resizer" 
		        xim-resizer
		        xim-resizer-width="10" 
		        xim-resizer-left="#angular-tree" 
		        xim-resizer-right="#angular-content"
		        xim-resizer-max="500"
		        xim-resizer-min="220">
		</div>
	</div>
</div>
