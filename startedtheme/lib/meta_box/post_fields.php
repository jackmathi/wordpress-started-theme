<?php

if( !class_exists( 'SiteSlider' ) ) {

	class SiteSlider {

		private $post_type = 'news';
		private $tag 	   = 'site_slider';

		public function __construct() {

			add_action( 'init', array( $this, 'register') );
			add_action( 'add_meta_boxes', array( $this, 'add_meta_box') );
			add_action( 'save_post', array( $this, 'save') );
			add_action( 'manage_'.$this->post_type.'_posts_columns', array( $this, 'table_head') );
			add_filter( 'manage_'.$this->post_type.'_posts_custom_column', array( $this, 'table_content') );
			//add_action( 'wp_head',  array( $this,'add_custom_villa_options'), 8 );
			add_shortcode( $this->tag, array( $this, 'shortcode' ) );
		}

		public function register() {

			$labels = array(
				'name'                	=> _x( 'Content area', 'Post Type General Name' ),
				'singular_name'       	=> _x( 'Content area', 'Post Type Singular Name' ),
				'menu_name'           	=> __( 'Content area' ),
				'name_admin_bar'      	=> __( 'Content area' ),
				'all_items'           	=> __( 'All Content area' ),
				'add_new_item'        	=> __( 'Add New Content area' ),
				'add_new'            	=> __( 'Add New' ),
				'new_item'            	=> __( 'New Content area' ),
				'edit_item'           	=> __( 'Edit Content area' ),
				'update_item'         	=> __( 'Update Content area' ),
				'view_item'           	=> __( 'View Content area' ),
				'featured_image' 	  	=> __( 'Content area Image' ),
				'set_featured_image'  	=> __( 'Set Content area Image' ),
				'remove_featured_image' => __( 'Remove Content area Image' ),
				'use_featured_image' 	=> __( 'Use Content area Image' ),
				'search_items'        	=> __( 'Search Content area' ),
				'not_found'           	=> __( 'No Content area found' ),
				'not_found_in_trash'  	=> __( 'No Content area found in Trash' ),
			);

			$args = array(
				'description'         => __( 'Create Content area in home page' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'excerpt', 'thumbnail', 'editor', 'page-attributes' ),
				'hierarchical'        => true,
				'public'              => true,
				'show_ui'             => true,
				'can_export'          => true,
        		'rewrite' => array('slug' => 'content','with_front' => TRUE,),
				'query_var'           => true,
				'menu_icon'           => 'dashicons-admin-multisite',
				'exclude_from_search' => true,
				'publicly_queryable'  => true,
				'capability_type'     => 'post',
			);

/*
>>>>>>> rc-manualvilla-sync
			register_post_type( $this->post_type, $args );
			register_taxonomy("villa_categories", "villas", array("hierarchical" => true,
		        "label" => "Villa Categories",
		        "singular_label" => "Villa Category",
		        'rewrite' => array('slug' => 'villa-categories','with_front' => FALSE,),
		        "query_var" => true,
		        "show_ui" => true
		            )

		    );*/

		}

		public function add_meta_box() {
			add_meta_box(
				'po_option'
				,'Availability Options'
				,array( $this, 'render_meta_box_content' )
				,array('news',$this->post_type)
				,'advanced'
				,'high'
			);
		}

		public function save( $post_id ) {

			if ( !isset($_POST['post_custom_box_nonce']) )
				return $post_id;

			$nonce = $_POST['post_custom_box_nonce'];

			if ( !wp_verify_nonce( $nonce, 'post_custom_box' ) )
				return $post_id;

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
				return $post_id;

			if ( $this->post_type == $_POST['post_type'] ) {

				if ( !current_user_can( 'edit_page', $post_id ) )
					return $post_id;

			} else {

				if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;

			}


			$fields = array( 'villa_address','villa_locations','villa_locality','villa_occation','villa_purpose','villa_latitude','villa_longtitude','villa_code','wc_mphb_room_type','bathroommphb_room_type','mphb_adults_capacity','bedrrommphb_room_type','villa_type_api','WC','villa_rate_def','villa_rate','villa_start_date','villa_end_date');

			
			foreach( $fields as $field ) {
				if( isset($_POST[$field]) ) {
					$value = sanitize_text_field( $_POST[$field] );
					update_post_meta( $post_id, $field, $value );
				}
			}

		}

		public function render_meta_box_content( $post ) {

			wp_nonce_field( 'villa_custom_box', 'villa_custom_box_nonce' );

			$villa_code = get_post_meta( $post->ID, 'villa_code', true );
			$wc_mphb_room_type = get_post_meta( $post->ID, 'wc_mphb_room_type', true );
			$bathroommphb_room_type = get_post_meta( $post->ID, 'bathroommphb_room_type', true );
			$bedrrommphb_room_type = get_post_meta( $post->ID, 'bedrrommphb_room_type', true );
			$WCD = get_post_meta( $post->ID, 'WC', true );

			$mphb_adults_capacity = get_post_meta( $post->ID, 'mphb_adults_capacity', true );

			$villa_type_api = get_post_meta( $post->ID, 'villa_type_api', true );

			// $villa_price = get_post_meta( $post->ID, 'villa_price', true );
			// $villa_filter = get_post_meta( $post->ID, 'villa_filter', trsue );
			// $villa_bed  = get_post_meta( $post->ID, 'villa_bed', true );
			$villa_locations  = get_post_meta( $post->ID, 'villa_locations', true );
			$villa_occation   = get_post_meta( $post->ID, 'villa_occation', true );
			$villa_locality   = get_post_meta( $post->ID, 'villa_locality', true );

		      $villa_purpose   = get_post_meta( $post->ID, 'villa_purpose', true );
		      $villa_rate   = get_post_meta( $post->ID, 'villa_rate', true );
		      
		      $villa_rate_def   = get_post_meta( $post->ID, 'villa_rate_def', true );
		      $villa_start_date   = get_post_meta( $post->ID, 'villa_start_date', true );
		      $villa_end_date   = get_post_meta( $post->ID, 'villa_end_date', true );
		      
		      // $villa_bath   = get_post_meta( $post->ID, 'villa_bath', true );
		      // $villa_pool  = get_post_meta( $post->ID, 'villa_pool', true );
		      // $villa_chkin  = get_post_meta( $post->ID, 'villa_chkin', true );
		      // $villa_chkout  = get_post_meta( $post->ID, 'villa_chkout', true );
		      // $villa_guest  = get_post_meta( $post->ID, 'villa_guest', true );
		      $villa_address  = get_post_meta( $post->ID, 'villa_address', true );

		      $villa_type  = get_post_meta( $post->ID, 'villa_type', true );
		      $villa_latitude  = get_post_meta( $post->ID, 'villa_latitude', true );
	      $villa_longtitude  = get_post_meta( $post->ID, 'villa_longtitude', true );
	      $villa_max_persons  = get_post_meta( $post->ID, 'villa_max_persons', true );
	      $jakuzzi  = get_post_meta( $post->ID, 'jakuzzi', true );
	      $wc=get_post_meta( $post->ID, 'wc_mphb_room_type', true );
	      $bathrooms=get_post_meta( $post->ID, 'bathroommphb_room_type', true );
	      $WCD=get_post_meta( $post->ID, 'WC', true );

			echo '<table width="100%" cellpadding="10px">';

		      echo '<tr>';
		      echo '<td><label for="villa_type_api"><strong> Type</strong></label></td>';
		      echo '<td><label for="villa_type_api"><strong>:</strong></label></td>';
		      echo '<td><select name="villa_type_api" id="villa_type_api" class=" ddd '.$villa_type_api.'" >';
		      echo '<option >--SELECT--</option>';
		      echo '<option value="manual" '.(($villa_type_api=='manual') ? "selected='selected'" : "").'>No online availability</option>';
		      echo '<option value="api" '.(($villa_type_api=='api') ? "selected='selected'" : "").'>WebHotelier villas</option>';      
		      echo '<option value="api_manu" '.(($villa_type_api=='api_manu') ? "selected='selected'" : "").'>Other Channels</option>';
		      echo '<option value="private" '.(($villa_type_api=='private') ? "selected='selected'" : "").'>Private</option>';
		      echo '</select></td>';
		      echo '</tr>';
	      
	      	$villa_type_api = $villa_type_api==''?'Manual':$villa_type_api;
			
			/*echo '<tr>';
		    echo '<td><label for="villa_type_api"><strong>Villa Type</strong></label></td>';
		    echo '<td>:</td>';
	    	echo '<td><input type="text" id="villa_code" name="villa_code" value="' . esc_attr( $villa_type_api) . '" style="width: 100%;" readonly /></td>';

			echo '<tr>';*/

			echo '<td><label for="villa_code"><strong> Code</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="villa_code" name="villa_code" value="' . esc_attr( $villa_code) . '" style="width: 100%;" /></td>';

			echo'</tr>';
			/*echo'</tr>';
>>>>>>> rc-manualvilla-sync
			echo '<tr>';
			echo '<td><label for="wc_mphb_room_type"><strong>WC</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="wc_mphb_room_type" name="wc_mphb_room_type" value="' . esc_attr( $wc_mphb_room_type) . '" style="width: 100%;" /></td>';
<<<<<<< HEAD
=======
			echo'</tr>';*/
			
			echo '<tr>';
			echo '<td><label for="bedrrommphb_room_type"><strong>Bedrooms</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="bedrrommphb_room_type" name="bedrrommphb_room_type" value="' . esc_attr( $bedrrommphb_room_type) . '" style="width: 100%;" /></td>';
			echo'</tr>';
			
			echo '<tr>';
			echo '<td><label for="mphb_adults_capacity"><strong>Guests</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="mphb_adults_capacity" name="mphb_adults_capacity" value="' . esc_attr( $mphb_adults_capacity) . '" style="width: 100%;" /></td>';
			echo'</tr>';

			echo '<tr>';
			echo '<td><label for="bathroommphb_room_type"><strong>Bathrooms</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="bathroommphb_room_type" name="bathroommphb_room_type" value="' . esc_attr( $bathroommphb_room_type) . '" style="width: 100%;" /></td>';
			echo'</tr>';

		
			echo '<tr>';
			echo '<td><label for="villa_rate"><strong> Rate(Range)</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="villa_rate" name="villa_rate" value="' . esc_attr( $villa_rate) . '" style="width: 30%;" /> Start Date : <input type="date" id="villa_start_date" name="villa_start_date" value="' . esc_attr( $villa_start_date) . '" style="width: 15%;" placeholder="Start Date" /> End Date : <input type="date" id="villa_end_date" name="villa_end_date" value="' . esc_attr( $villa_end_date) . '" style="width: 15%;" placeholder="Start Date" /></td>';
			echo '<td></td>';
			echo '<td></td>';
			echo'</tr>';
		    echo '<tr>';
			echo '<td><label for="villa_rate_def"><strong> Rate(Default)</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="villa_rate_def" name="villa_rate_def" value="' . esc_attr( $villa_rate_def) . '" style="width: 100%;" /></td>';
			echo'</tr>';

		    
		      echo '<tr>';
		      echo '<td><label for="villa_locations"><strong>Destinations</strong></label></td>';
		      echo '<td>:</td>';
		      echo '<td><select name="villa_locations" id="villa_locations" class="'.$villa_locations.'" >';
		      echo '<option >--SELECT--</option>';
		                  $villargs = array(
		                    'numberposts' =>-1,
		                    'post_type' => 'destination',
		                    'orderby' => 'menu_order',
		                    'order' => 'ASC',
		                  );
		                  $villaLocs = get_posts($villargs);
		                  foreach($villaLocs as $villaLoc) {
		                     $title = $villaLoc->post_title;

               
		      echo '<option value="'.$title.'" '.(($villa_locations==$title) ? "selected='selected'" : "").'>'.$title.'</option>';

		                  }

		      echo '</select></td>';
		      echo'</tr>';
/*villa occation*/
		      
/*villa occation*/
/*villa locatity*/
		      
		      echo '<tr>';
		      echo '<td><label for="villa_purpose"><strong>Occasion</strong></label></td>';
		      echo '<td>:</td>';
		      echo '<td><select name="villa_purpose" id="villa_purpose">';
		      echo '<option >--SELECT--</option>';
                  $Proargs = array(
                    'numberposts' =>-1,
                    'post_type' => 'purpose',
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                  );
                  $villaPros = get_posts($Proargs);
                  foreach($villaPros as $villaPro) {
                     $titlePro = $villaPro->post_title;

	      echo '<option value="'.$titlePro.'" '.(($villa_purpose==$titlePro) ? "selected='selected'" : "").'>'.$titlePro.'</option>';
	                  }
	      echo '</select></td>';
	      echo'</tr>';

	      /*echo '<tr>';
	      echo '<td><label for="villa_chkin"><strong>Check-in</strong></label></td>';
	      echo '<td>:</td>';
	      echo '<td><input type="date" id="villa_chkin" name="villa_chkin" value="' . esc_attr( $villa_chkin) . '" style="width: 100%;"/></td>';
	      echo'</tr>';

	      echo '<tr>';
	      echo '<td><label for="villa_chkout"><strong>Check-out</strong></label></td>';
	      echo '<td>:</td>';
	      echo '<td><input type="date" id="villa_chkout" name="villa_chkout" value="' . esc_attr( $villa_chkout) . '" style="width: 100%;"/></td>';
	      echo'</tr>';

	      echo '<tr>';
		echo '<td><label for="villa_bed"><strong>Bedrooms</strong></label></td>';
		echo '<td>:</td>';
		echo '<td><input type="text" id="villa_bed" name="villa_bed" value="' . esc_attr( $villa_bed ) . '" style="width: 100%;"/></td>';
		echo'</tr>';*/

	
		/*echo '<tr>';
		echo '<td><label for="villa_price"><strong>Price</strong></label></td>';
		echo '<td>:</td>';
		echo '<td><input type="text" id="villa_price" name="villa_price" value="' . esc_attr( $villa_price ) . '" style="width: 100%;"/></td>';
		echo'</tr>';*/





/* echo '<tr>';
      echo '<td><label for="villa_price"><strong>Price</strong></label></td>';
      echo '<td>:</td>';
      echo '<td><select name="villa_price" id="villa_price">';
                  $Proargs2 = array(
                    'numberposts' =>-1,
                    'post_type' => 'price',
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                  );
                  $villaPros2 = get_posts($Proargs2);
                  foreach($villaPros2 as $villaPro2) {
                     $titlePro2 = $villaPro2->post_title;

      echo '<option value="'.$titlePro2.'" '.(($villa_price==$titlePro2) ? "selected='selected'" : "").'>'.$titlePro2.'</option>';
                  }
      echo '</select></td>';
      echo'</tr>';*/

      // echo '<tr>';
      // echo '<td><label for="villa_price"><strong>Price</strong></label></td>';
      // echo '<td>:</td>';
      // echo '<td><input type="text" id="villa_price" name="_villa_price" value="' . esc_attr( $villa_price ) . '" style="width: 100%;"/></td>';
      // echo'</tr>';


      /*echo '<tr>';
			echo '<td><label for="villa_guest"><strong>Guests</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="villa_guest" name="villa_guest" value="' . esc_attr( $villa_guest) . '" style="width: 100%;"/></td>';
			echo'</tr>';

			echo '<tr>';
			echo '<td><label for="villa_guest"><strong>Jakuzzi</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="jakuzzi" name="jakuzzi" value="' . esc_attr( $jakuzzi) . '" style="width: 100%;"/></td>';
			echo'</tr>';

	echo '<tr>';
			echo '<td><label for="villa_max_persons"><strong>Maximum persons</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="villa_max_persons" name="villa_max_persons" value="' . esc_attr( $villa_max_persons) . '" style="width: 100%;"/></td>';
			echo'</tr>';

      echo '<tr>';
			echo '<td><label for="villa_bath"><strong>Bathrooms</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="villa_bath" name="villa_bath" value="' . esc_attr( $villa_bath) . '" style="width: 100%;"/></td>';
			echo'</tr>';

      echo '<tr>';
			echo '<td><label for="villa_pool"><strong>No.of.Pools</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="villa_pool" name="villa_pool" value="' . esc_attr( $villa_pool) . '" style="width: 100%;"/></td>';
			echo'</tr>';
*/
      echo '<tr>';
			echo '<td><label for="villa_address"><strong>Address</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="villa_address" name="villa_address" value="' . esc_attr( $villa_address) . '" style="width: 100%;"/></td>';
			echo'</tr>';
     /* echo '<tr>';
			echo '<td><label for="villa_address"><strong>Address</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="villa_address" name="villa_address" value="' . esc_attr( $villa_address) . '" style="width: 100%;"/></td>';
			echo'</tr>';*/


 // echo '<tr>';
 //      echo '<td><label for="villa_filter"><strong>More Filter</strong></label></td>';
 //      echo '<td>:</td>';
    
 //                  $Proargs21 = array(
 //                    'numberposts' =>-1,
 //                    'post_type' => 'filter',
 //                    'orderby' => 'menu_order',
 //                    'order' => 'ASC',
 //                  );
 //                  $villaPros21 = get_posts($Proargs21);
 //                  foreach($villaPros21 as $villaPro21) {
 //                     $titlePro21 = $villaPro21->post_title;

 //      // echo '<option value="'.$titlePro21.'" '.(($villa_filter==$titlePro21) ? "selected='selected'" : "").'>'.$titlePro21.'</option>';

 //      	echo '<td><input type="checkbox" id="villa_filter" name="villa_filter" value="'.$titlePro21.'" '.(($villa_filter==$titlePro21) ? "selected='selected'" : "").'" style="width: 100%;"/>'.$titlePro21.'</td>';
         
                          
 //                           }

      
 //      echo'</tr>';



			echo '<tr>';
			echo '<td><label for="villa_latitude"><strong>Latitude</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="villa_latitude" name="villa_latitude" value="' . esc_attr( $villa_latitude) . '" style="width: 100%;"/></td>';
			echo'</tr>';

			echo '<tr>';
			echo '<td><label for="villa_longtitude"><strong>Longtitude</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="villa_longtitude" name="villa_longtitude" value="' . esc_attr( $villa_longtitude) . '" style="width: 100%;"/></td>';
			echo'</tr>';








			echo '</table>';


		}



		public function table_head( $columns ) {

			$columns = array(
				"cb"		=> '<input type="checkbox" />',
				"title" 	=> 'Title',
				"date" 		=> 'Date'
			);

			return $columns;

		}

		function table_content( $column ) {
			global $post;

			switch( $column ) {
				case "image":
				if( has_post_thumbnail( $post->ID ) ) {
					the_post_thumbnail(array('75', '75'));
				}
				break;

				case "order":
					echo $post->menu_order;
				break;
			}
		}




	}

	new SiteSlider;
}

