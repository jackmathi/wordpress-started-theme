	<?php 
	add_action( 'init', "registerPrcTypeTaxonomy" );
    
function registerPrcTypeTaxonomy(){

		$labels = array(
			'name'						 => __( 'Villa Category', 'motopress-hotel-booking' ),
			'singular_name'				 => __( 'Villa Category', 'motopress-hotel-booking' ),
			'search_items'				 => __( 'Search Villa Categories', 'motopress-hotel-booking' ),
			'popular_items'				 => __( 'Popular Villa Categories', 'motopress-hotel-booking' ),
			'all_items'					 => __( 'All Villa Categories', 'motopress-hotel-booking' ),
			'parent_item'				 => __( 'Parent Villa Category', 'motopress-hotel-booking' ),
			'parent_item_colon'			 => __( 'Parent Villa Category:', 'motopress-hotel-booking' ),
			'edit_item'					 => __( 'Edit Villa Category', 'motopress-hotel-booking' ),
			'update_item'				 => __( 'Update Villa Category', 'motopress-hotel-booking' ),
			'add_new_item'				 => __( 'Add New Villa Category', 'motopress-hotel-booking' ),
			'new_item_name'				 => __( 'New Villa Category Name', 'motopress-hotel-booking' ),
			'separate_items_with_commas' => __( 'Separate Price types with commas', 'motopress-hotel-booking' ),
			'add_or_remove_items'		 => __( 'Add or remove Price types', 'motopress-hotel-booking' ),
			'choose_from_most_used'		 => __( 'Choose from the most used Price types', 'motopress-hotel-booking' ),
			'not_found'					 => __( 'No  found.', 'motopress-hotel-booking' ),
			'menu_name'					 => __( 'Price type', 'motopress-hotel-booking' )
		);

		$args = array(
			'labels'			 => $labels,
			'public'			 => true,
			'hierarchical'		 => true,
			'show_ui'			 => true,
			//'show_in_menu'		 => MPHB()->menus()->getMainMenuSlug(),
			'show_tagcloud'		 => true,
			'show_admin_column'	 => true,
			'rewrite'			 => array(
			//translators: do not translate
				'slug'			 => _x( 'accommodation-prc-type', 'slug', 'motopress-hotel-booking' ),
				'with_front'	 => false,
				'hierarchical'	 => true
			),
			'query_var'			 => true,
			'show_in_rest'       => true
		);

		register_taxonomy( 'mphb_room_type_prc_typ', 'mphb_room_type', $args );

		register_taxonomy_for_object_type( 'mphb_room_type_prc_typ', 'mphb_room_type' );

	}
	add_action( 'init', "registerStyleTaxonomy" );

       
		function registerStyleTaxonomy(){

		$labels = array(
			'name'						 => __( 'Villa Style', 'motopress-hotel-booking' ),
			'singular_name'				 => __( 'Villa Style', 'motopress-hotel-booking' ),
			'search_items'				 => __( 'Search Villa Styles', 'motopress-hotel-booking' ),
			'popular_items'				 => __( 'Popular Villa Styles', 'motopress-hotel-booking' ),
			'all_items'					 => __( 'All Villa Styles', 'motopress-hotel-booking' ),
			'parent_item'				 => __( 'Parent Villa Style', 'motopress-hotel-booking' ),
			'parent_item_colon'			 => __( 'Parent Villa Style:', 'motopress-hotel-booking' ),
			'edit_item'					 => __( 'Edit Villa Style', 'motopress-hotel-booking' ),
			'update_item'				 => __( 'Update Villa Style', 'motopress-hotel-booking' ),
			'add_new_item'				 => __( 'Add New Villa Style', 'motopress-hotel-booking' ),
			'new_item_name'				 => __( 'New Villa Style Name', 'motopress-hotel-booking' ),
			'separate_items_with_commas' => __( 'Separate Styles with commas', 'motopress-hotel-booking' ),
			'add_or_remove_items'		 => __( 'Add or remove Styles', 'motopress-hotel-booking' ),
			'choose_from_most_used'		 => __( 'Choose from the most used Styles', 'motopress-hotel-booking' ),
			'not_found'					 => __( 'No Styles found.', 'motopress-hotel-booking' ),
			'menu_name'					 => __( 'Styles', 'motopress-hotel-booking' )
		);

		$args = array(
			'labels'			 => $labels,
			'public'			 => true,
			'hierarchical'		 => true,
			'show_ui'			 => true,
			//'show_in_menu'		 => MPHB()->menus()->getMainMenuSlug(),
			'show_tagcloud'		 => true,
			'show_admin_column'	 => true,
			'rewrite'			 => array(
			//translators: do not translate
				'slug'			 => _x( 'accommodation-style', 'slug', 'motopress-hotel-booking' ),
				'with_front'	 => false,
				'hierarchical'	 => true
			),
			'query_var'			 => true,
			'show_in_rest'       => true
		);

		register_taxonomy( 'mphb_room_type_style', 'mphb_room_type', $args );

		register_taxonomy_for_object_type( 'mphb_room_type_style', 'mphb_room_type' );

	}
	add_action( 'init', "registerLocTaxononomy" );
	function registerLocTaxononomy(){

		$labels = array(
			'name'						 => __( 'Area Location', 'motopress-hotel-booking' ),
			'singular_name'				 => __( 'Area Location', 'motopress-hotel-booking' ),
			'search_items'				 => __( 'Search Area Locations', 'motopress-hotel-booking' ),
			'popular_items'				 => __( 'Popular Area Locations', 'motopress-hotel-booking' ),
			'all_items'					 => __( 'All Area Locations', 'motopress-hotel-booking' ),
			'parent_item'				 => __( 'Parent Area Location', 'motopress-hotel-booking' ),
			'parent_item_colon'			 => __( 'Parent Area Location:', 'motopress-hotel-booking' ),
			'edit_item'					 => __( 'Edit Area Location', 'motopress-hotel-booking' ),
			'update_item'				 => __( 'Update Area Location', 'motopress-hotel-booking' ),
			'add_new_item'				 => __( 'Add New Area Location', 'motopress-hotel-booking' ),
			'new_item_name'				 => __( 'New Area Location Name', 'motopress-hotel-booking' ),
			'separate_items_with_commas' => __( 'Separate Locations with commas', 'motopress-hotel-booking' ),
			'add_or_remove_items'		 => __( 'Add or remove Locations', 'motopress-hotel-booking' ),
			'choose_from_most_used'		 => __( 'Choose from the most used Locations', 'motopress-hotel-booking' ),
			'not_found'					 => __( 'No Locations found.', 'motopress-hotel-booking' ),
			'menu_name'					 => __( 'Locations', 'motopress-hotel-booking' )
		);

		$args = array(
			'labels'			 => $labels,
			'public'			 => true,
			'hierarchical'		 => true,
			'show_ui'			 => true,
			//'show_in_menu'		 => MPHB()->menus()->getMainMenuSlug(),
			'show_tagcloud'		 => true,
			'show_admin_column'	 => true,
			'rewrite'			 => array(
			//translators: do not translate
				'slug'			 => _x( 'accommodation-loc', 'slug', 'motopress-hotel-booking' ),
				'with_front'	 => false,
				'hierarchical'	 => true
			),
			'query_var'			 => true,
			'show_in_rest'       => true
		);

		register_taxonomy( 'mphb_room_type_loc', 'mphb_room_type', $args );

		register_taxonomy_for_object_type( 'mphb_room_type_loc', 'mphb_room_type' );

	}
	
	add_action( 'init', "registerOccasionTaxononomy" );
	function registerOccasionTaxononomy(){

		$labels = array(
			'name'						 => __( 'Holiday Occasion', 'motopress-hotel-booking' ),
			'singular_name'				 => __( 'Holiday Occasion', 'motopress-hotel-booking' ),
			'search_items'				 => __( 'Search Holiday Occasions', 'motopress-hotel-booking' ),
			'popular_items'				 => __( 'Popular Holiday Occasions', 'motopress-hotel-booking' ),
			'all_items'					 => __( 'All Holiday Occasions', 'motopress-hotel-booking' ),
			'parent_item'				 => __( 'Parent Holiday Occasion', 'motopress-hotel-booking' ),
			'parent_item_colon'			 => __( 'Parent Holiday Occasion:', 'motopress-hotel-booking' ),
			'edit_item'					 => __( 'Edit Holiday Occasion', 'motopress-hotel-booking' ),
			'update_item'				 => __( 'Update Holiday Occasion', 'motopress-hotel-booking' ),
			'add_new_item'				 => __( 'Add New Holiday Occasion', 'motopress-hotel-booking' ),
			'new_item_name'				 => __( 'New Holiday Occasion Name', 'motopress-hotel-booking' ),
			'separate_items_with_commas' => __( 'Separate Occasions with commas', 'motopress-hotel-booking' ),
			'add_or_remove_items'		 => __( 'Add or remove Occasions', 'motopress-hotel-booking' ),
			'choose_from_most_used'		 => __( 'Choose from the most used Occasions', 'motopress-hotel-booking' ),
			'not_found'					 => __( 'No Occasions found.', 'motopress-hotel-booking' ),
			'menu_name'					 => __( 'Occasions', 'motopress-hotel-booking' )
		);

		$args = array(
			'labels'			 => $labels,
			'public'			 => true,
			'hierarchical'		 => true,
			'show_ui'			 => true,
		//	'show_in_menu'		 => MPHB()->menus()->getMainMenuSlug(),
			'show_tagcloud'		 => true,
			'show_admin_column'	 => true,
			'rewrite'			 => array(
			//translators: do not translate
				'slug'			 => _x( 'accommodation-occasion', 'slug', 'motopress-hotel-booking' ),
				'with_front'	 => false,
				'hierarchical'	 => true
			),
			'query_var'			 => true,
			'show_in_rest'       => true
		);

		register_taxonomy( 'mphb_room_type_occ', 'mphb_room_type', $args );

		register_taxonomy_for_object_type( 'mphb_room_type_occ', 'mphb_room_type' );

	}
	?>