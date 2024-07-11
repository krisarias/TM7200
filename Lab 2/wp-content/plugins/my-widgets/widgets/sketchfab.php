<?php

// Prevent direct access if the ABSPATH constant is not defined
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Use namespaces for Elementor classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Register the widget with Elementor upon initialization
add_action( 'elementor/init', function() {

    // Define the SketchFab_Widget class extending Elementor's Widget_Base
    class SketchFab_Widget extends Widget_Base {

        // Return a unique name for the widget
        public function get_name() {
            return 'sketchfab-widget';
        }

        // Return the widget title that will be displayed in the UI
        public function get_title() {
            return __( 'SketchFab', 'my-widgets' );
        }

        // Return the widget icon for the Elementor editor
        public function get_icon() {
            return 'eicon-post-content';
        }

        // Define the category for this widget to appear in the Elementor editor
        public function get_categories() {
            return [ 'my-widgets' ]; // Category name
        }

        // List script dependencies for the widget
        public function get_script_depends() {
            return ["sketchfab-script"];
        }

        // List style dependencies for the widget
        public function get_style_depends() {
            return ["sketchfab-style"];
        }

        // Register widget controls for the Elementor editor
        protected function _register_controls() {
            // Start a new controls section
            $this->start_controls_section(
                'content_section', [
                    'label' => __( 'Options', 'my-widgets' ),
                ]
            );

            // Add a text control for the SketchFab URL
            $this->add_control(
                'url-sketchfab', [
                    'label' => __( 'URL', 'my-widgets' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => '',
                ]
            );

            // End the controls section
            $this->end_controls_section();
        }

        // Render the widget output in the frontend
        protected function render() {
            // Get widget settings
            $settings = $this->get_settings_for_display();
            $sketchfab_url = $settings['url-sketchfab'];
            
            // Output the iframe with the SketchFab URL
            ?>
            <div class="sketchfab-container">
                <iframe src="<?php echo $sketchfab_url; ?>" 
                title="Sketchfab"
                width="600" 
                height="450" 
                allow="autoplay; fullscreen; vr"
                frameborder="0">
                </iframe>
            </div>
            <?php
        }
    };

    // Function to register the SketchFab_Widget with Elementor
    function register_SketchFab_Widget() {
        \Elementor\Plugin::instance()->widgets_manager->register( new SketchFab_Widget() );
    }

    // Hook to register the widget once all widgets have been registered
    add_action( 'elementor/widgets/widgets_registered', 'register_SketchFab_Widget' );
});