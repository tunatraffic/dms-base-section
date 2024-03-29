<?php
/*
	Section: Tuna's Base Section
	Author: Tuna Traffic
	Author URI: http://tunatraffic.com
	Description: A base section to be used to start new sections.
	Class Name: tunaBaseSection
	Demo:
	Version: 1.3
	Filter: component
*/

/**
 * DMS Meta Info Tips

	// You can set the filter value to one of the following: component, layout, full-width, format, gallery , nav, slider, social, widgetized, misc
	// There are a few additional headers you can utlize. One of which is a full-width filter that forces the section full-width. The other is an active loading filter, which, when applied, doesn't require a page refresh for the section to show up. however, sections with javascript shouldn't use this.
*/



class tunaBaseSection extends PageLinesSection {

	const version = '1.3';  // Declares a version, used in tracking the version of the script. For some reason it's needed with DMS along with declaring true at the end of the script to force into the footer

    // READY TO USE VARIABLES
    // $this->id;          section slug, in this case its tt-section
    // $this->base_url;    the base url of the section
    // $this->base_dir;    the base directory of the section
    // $this->images;      create an /images directory in your section, then use this variable for the path
    // $this->screenshot;  the section thumb
    // $this->splash;      the section splash
    // $this->description  get the description from the header
    // get_the_id();       retrieves the clone id of the section

    // RUNS ALL TIME - This loads all the time, even if the section isn't on the page. Stuff like actions and things can go here, as well as post type setup functions
    function section_persistent(){}

    // LOAD SCRIPTS
    function section_scripts(){
        //wp_enqueue_script('script-name', $this->base_url.'/script.js', array('jquery'), self::version, true );
    }

    // RUNS IN <HEAD>
    function section_head() {

    	// Always use jQuery and never $ to avoid issues with other store products

        /*
    	?><script>
	    	jQuery(document).ready(function(){

	    	});
    	</script><?php
    	*/

        // This is only needed if you'll be using custom fonts
        // echo load_custom_font($this->opt('tt_custom_font'), '.target-class');

    }

    // BEFORE SECTION - this adds a class to the section wrap. you can also put HTML here and it will run outside of the section, and before it
    function before_section_template( $location = '', $clone_id = null ) {

		//$this->wrapper_classes['background'] = 'special-class';

	}

    // SECTION MARKUP - This is the function that outputs all the HTML onto the page. Put all your viewable content here
   	function section_template() {

        echo 'hi';

        // call settings like so
        // $var = $this->opt($this->id.'_some_key');


        // print iterated options - as of 1.1
		$my_array 	= $this->opt('sample_item_array');
		$out 		= '';

		if( is_array($my_array) ){ // check if something is in the array (user set)

			foreach( $my_array as $thing ){

				$getlink	= pl_array_get('link', $thing);
				$geticon 	= pl_array_get('icon', $thing, 'globe'); // passing a default as a 3rd param

				$out    	.= sprintf('<a class="btn" href="%s"><i class="icon-%s"></i></a>',$getlink,$geticon);
			}

		} else {

			echo setup_section_notify($this); // if nothing is set tell them to do something
		}

		printf('<div class="icon-wrap">%s</div>',$out); //print out the stuff

   	}

    // RUNS IN <FOOTER> - This is just like using wp_footer so this stuffs will in the footer of your site
	function section_foot(){}


    // WELCOME MESSAGE - HTML content for the welcome/intro option field
	function welcome(){

		ob_start();

		?><div style="font-size:12px;line-height:14px;color:#444;"><p><?php _e('You can have some custom text here.','tt-section');?></p></div><?php

		return ob_get_clean();
	}

    // SECTION OPTIONS - draws out the section options. This symbol * denotes optional fields.
	function section_opts(){

		$options = array();

        // Anatomy of an option type
        $opts[] = array(
            'key'                   => $this->id.'_some_key', // name of the key unique to this option
            'col'                   => 2, //set how many columns the option spans
            'type'                  => 'text', // Option Type
            'title'                 => __('Super Cool Option', 'tt-section'), // same as 'label' if omitted
            'label'                 => __('Select Cool Option', 'tt-section'),
            'help'                  => __('Help text goes here. How nice of you!', 'tt-section'),
            'ref'                   => __( 'This creates a help field with a toggle.', 'tt-section' )
        );

        // Welcome
		$options[] = array(
            'span'                  => 2, // special type that makes the option wider
            'key'                   => $this->id.'_some_key',
            'type'                  => 'template',
            'title'                 => __('Welcome to My Section','tt-section'),
            'template'              => $this->welcome()
        );

        // Count select
		$options[] = array(
            'key'                   => $this->id.'_some_key',
            'type'                  => 'count_select',
            'title'                 => __('Count Select','tt-section'),
            'count_start'           => 1,            // Starting Count Number
            'count_number'          => 100,          // Ending Count Number
            //'suffix'                => '%'          // * Added to the end of the value and optional
        );

        // Image Upload
        $options[] = array(
            'key'                   => $this->id.'_some_key',
            'type'                  => 'image_upload',
            'title'                 => __('Image Upload','tt-section'),
            'imgsize'               => '16',        // * The image preview 'max' size
            'sizelimit'             => '512000',     // * Image upload max size default 512kb
        );

        // Color Picker
        $options[] = array(
            'key'                   => $this->id.'_some_key',
            'type'                  => 'color',
            'title'                 => __('Color Picker','tt-section'),
            'default'               => '#FFFFFF', // always set a default

        );

        // Text, Textareas and Checkboxes
        $options[] = array(
            'key'                   => $this->id.'_some_key',
            'type'                  => 'text',  // or "textarea" or "check"
            'title'                 => __('Text','tt-section'),
        );

        // Select Menu
        $options[] = array(
            'key'                   => $this->id.'_some_key',
            'type'                  => 'select_menu',
            'title'                 => __('Menu Select','tt-section'),
        );

        // Fonts - there is a second step required in order to get this part working. in section head, there's an example showing how to load a custom font, targeting a specific class in your section
        $options[] = array(
            'key'                   => $this->id.'_some_key',
            'type'                  => 'type',
            'title'                 => __('Pick a Font','tt-section'),
        );

        // Icon selector
        $options[] = array(
            'key'                   => $this->id.'_some_key',
            'type'                  => 'select_icon',
            'title'                 => __('Select an icon','tt-section'),
            'default'               => 'rocket'
        );

        // Link
        $options[] = array(
            'key'                   => $this->id.'_some_key',
            'type'                  => 'link',
            'title'                 => __('Visit this link','tt-section'),
            'url'                   => 'http://www.pagelinesdevcamp.com',
            'classes'               => 'btn-info' // you can also use btn-primary, btn-warning, btn-success, btn-inverse
        );

        // Button Select
        $options[] = array(
            'key'                   => $this->id.'_some_key',
            'type'                  => 'select_button',
            'title'                 => __('Select a button','tt-section'),
        );

        // Multi Select
		$options[] = array(
			'type'	                => 'multi', // here you can nest multiple options
			'title'                 => __( 'Multiple Option Configuration', 'tt-section' ),
			'opts'	                => array(
				array(
					'key'			=> $this->id.'_some_key',
					'type' 			=> 'count_select',
					'count_start'	=> 1,
					'count_number'	=> 12,
					'default'		=> 4,
					'label' 	    => __( 'Counter', 'tt-section' ),
				),
				array(
					'key'			=> $this->id.'_some_key',
					'type' 			=> 'color',
					'label' 	    => __( 'Color Picker', 'tt-section' ),
					'default'       => '#0077CC'
				),
			)

		);

		// Iterated Options - as of DMS 1.1
		$options[] = array(
			'key'				=> 'sample_item_array',
			'type'				=> 'accordion',
			'title'				=> __('Sample Item Array', 'tt-section'),
			'col'				=> 4,
			'opts' 				=> array(
				array(
					'key'		=> 'link', // dont worry about namespacing these at all they fall within your key scope above
					'label'		=> __( 'Link', 'tt-section' ),
					'type'		=> 'text'
				),
				array(
					'key'		=> 'icon', // dont worry about namespacing these at all they fall within your key scope above
					'label'		=> __( 'Icon', 'tt-section' ),
					'type'		=> 'select_icon'
				),
			)
		);

		return $options;
	}

} // that's it, that's the end of it. never put code past this area as it's then out of the class
