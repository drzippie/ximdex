angular.module('ximdex.common.directive')
	.directive('ximResizer', function($document) {
		//TODO: Make it jquery independet
		return function($scope, $element, $attrs) {

			$element.on('mousedown', function(event) {
				event.preventDefault();

				$document.on('mousemove', mousemove);
				$document.on('mouseup', mouseup);
			});

			function mousemove(event) {
				// Handle vertical resizer
				var x = event.pageX;

				if ($attrs.ximResizerMax && x > $attrs.ximResizerMax) {
					x = parseInt($attrs.ximResizerMax);
				}
				if ($attrs.ximResizerMin && x < $attrs.ximResizerMin) {
					x = parseInt($attrs.ximResizerMin);
				}

				$element.css({
					left: x + 'px'
				});

				$($attrs.ximResizerLeft).css({
					width: x + 'px'
				});
				$($attrs.ximResizerRight).css({
					left: (x + parseInt($attrs.ximResizerWidth)) + 'px'
				});

			}

			function mouseup() {
				$document.unbind('mousemove', mousemove);
				$document.unbind('mouseup', mouseup);
			}
		};
	});