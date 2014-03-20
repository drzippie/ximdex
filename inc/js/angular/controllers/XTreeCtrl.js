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
angular.module('ximdex.main.controller')
    .controller('XTreeCtrl', ['$scope', '$attrs', 'xBackend', 'xTranslate', '$window', '$http', 'xUrlHelper', 'xMenu', function($scope, $attrs, xBackend, xTranslate, $window, $http, xUrlHelper, xMenu){
	    
	    var loadAction = function(action) {
	    	console.log("LOADING", action);
	    }

	    $scope.twoLevelLoad = true;

	    $http.get(xUrlHelper.getAction({action: 'browser3', method: 'nodetypes'})).success(function(data){
	    	if (data && data.nodetypes) {
	    		$scope.nodetypes = data.nodetypes;
	    		$scope.nodetypes = {}
	    		for (var i = data.nodetypes.length - 1; i >= 0; i--) {
	    			$scope.nodetypes[data.nodetypes[i].idnodetype] = data.nodetypes[i];
	    		};
	    	}
	    });

	    //TODO: Get initial nodeid from backend
	    $http.get(xUrlHelper.getAction({action: 'browser3', method: 'read', id: '10000'})).success(function(data){
	    	if (data) {
	    		$scope.tree = data;
	    	}
	    });

	    $scope.toggleNode = function(node) {
	    	node.showNodes = !node.showNodes;
	    	if (node.showNodes && !node.collection) {
	    		$scope.loadChilds(node);		
	    	}
	    }

	    $scope.loadChilds = function(node) {
	    	$scope.loadNodeChilds(node, function(nodes){
	    		if($scope.twoLevelLoad) {
	    			$scope.loadNodesChilds(nodes)
	    		}
	    	});		
	    }
	    
	    $scope.loadNodeChilds = function(node, callback) {
		    if (node.children && !node.loading) {	
		    	node.loading = true;
	    		$http.get(xUrlHelper.getAction({action: 'browser3', method: 'read', id: node.nodeid}))
		    		.success(function(data){
		    			node.loading = false;
		    			if (data) {
		    				node.collection = data.collection;
		    				if (callback) {
		    					callback(node.collection);
		    				}
		    			}
		    		}).error(function(data){
		    			node.loading = false;
		    		}
		    	);
	    	}	
	    }

	    $scope.loadNodesChilds = function(nodes) {
	    	if (nodes.length < 10) {
		    	for (var i = nodes.length - 1; i >= 0; i--) {
		    		$scope.loadNodeChilds(nodes[i]);
		    	};
		    }
	    }

	    $scope.loadActions = function(node) {
	    	if (!node.actions) {
	    		$http.get(xUrlHelper.getAction({action: 'browser3', method: 'cmenu', id: node.nodeid}))
		    		.success(function(data){
		    			if(data) {
		    				node.actions = data;
		    				xMenu.open(data, loadAction);
		    			}
		    		}
		    	);
	    	}
	    }
    }]);