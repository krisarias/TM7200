(function($) {
    const sketchfabWidgetHandle = function($scope, $) {
        console.log('testing');
    };
    $(window).on('elementor/frontend/init', function($scope) {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/sketchfab-widget.default', 
            sketchfabWidgetHandle
        );
    });
})(jQuery);