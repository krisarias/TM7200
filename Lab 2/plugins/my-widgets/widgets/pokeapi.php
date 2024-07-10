<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

add_action( 'elementor/init', function() {

    class PokeApi_Widget extends Widget_Base {

        public function get_name() {
            return 'pokeapi-widget';
        }

        public function get_title() {
            return __( 'PokeApi', 'my-widgets' );
        }

        public function get_icon() {
            return 'eicon-facebook-like-box';
        }

        public function get_categories() {
            return [ 'my-widgets' ]; // Category name
        }

        public function get_script_depends() {
            return ["pokeapi-script"];
        }

        public function get_style_depends() {
            return ["pokeapi-style"];
        }

        protected function _register_controls() {
            $this->start_controls_section(
                'content_section', [
                    'label' => __( 'Options', 'my-widgets' ),
                ]
            );
            $this->add_control('banner', [
                    'label' => __( 'banner', 'my-widgets' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                ]
            );
            $this->end_controls_section();
        }

        protected function render() {
            $settings = $this->get_settings_for_display();
            $banner = $settings['banner']['url'];
            ?>
            <div class="pokeapi-container "    >
            <img class="banner " src="<?php echo $banner; ?>" alt="banner">
            
            <ul id="pokelist" class="pokelist"></ul>
            </div>
            <?php
        }
    };

    function register_PokeApi_Widget() {
        \Elementor\Plugin::instance()->widgets_manager->register( new PokeApi_Widget() );
    }
    add_action( 'elementor/widgets/widgets_registered', 'register_PokeApi_Widget' );
});