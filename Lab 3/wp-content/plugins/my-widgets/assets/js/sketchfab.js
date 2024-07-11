(function($) {
    // Define the handler function for the Sketchfab widget
    const sketchfabWidgetHandle = function($scope, $) {
        console.log('testing');
    };
    // Listen for the Elementor frontend initialization event
    $(window).on('elementor/frontend/init', function($scope) {
        // Add action hook for when the Sketchfab widget is ready
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/sketchfab-widget.default', 
            sketchfabWidgetHandle // Attach the handler function
        );
    });
})(jQuery);

