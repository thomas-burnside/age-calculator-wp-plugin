<?php
/**
 * Plugin Name: TB #1 Age Calculator 
 * Description: A simple age calculator plugin for WordPress.
 * Version: 1.0.0
 * Author: Thomas Burnside
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

//function debug background color
function age_calculator_body_class($classes) {
    if (is_singular() && has_shortcode(get_post()->post_content, 'age_calculator')) {
        $classes[] = 'age-calculator-active';
    }
    return $classes;
}
add_filter('body_class', 'age_calculator_body_class');



// Enqueue styles and scripts
function age_calculator_enqueue_assets() {
    if (is_singular() && has_shortcode(get_post()->post_content, 'age_calculator')) {
        wp_enqueue_style(
            'age-calculator-style',
            plugin_dir_url(__FILE__) . 'assets/css/style.css'
        );

        wp_enqueue_script(
            'age-calculator-script',
            plugin_dir_url(__FILE__) . 'assets/js/script.js',
            [],
            null,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'age_calculator_enqueue_assets');

// Add shortcode for the age calculator
function age_calculator_shortcode() {
    ob_start();
    ?>
    <div class="age-calculator">
        <div class="container">
        <h1>Age Calculator</h1>
        <div class="form">
            <label for="birthday">Enter your date of birth</label>
            <input type="date" id="birthday" name="birthday">
            <button id="btn">Calculate Age</button>
            <p id="result"></p>
        </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('age_calculator', 'age_calculator_shortcode');
