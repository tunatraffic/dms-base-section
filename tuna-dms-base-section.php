<?php
/*
	Plugin Name: Tuna's Base Section
	Author: Tuna Traffic
	Author URI: http://tunatraffic.com
	Description: A base section to be used to start new sections.
	Class Name: tunaBaseSection
	Demo:
	Version: 1.0
*/

// Add a LESS file
        function tt_insert_less() {
        $file = sprintf( '%sstyle.less', plugin_dir_path( __FILE__ ) );
        if(function_exists('pagelines_insert_core_less')) {
            pagelines_insert_core_less( $file );
        }
    }