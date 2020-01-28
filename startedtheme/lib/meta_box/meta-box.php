<?php
/*** Metabox for page, post ***/

add_action("add_meta_boxes", "add_page_settings_custom_meta_box");
add_action("save_post", "save_page_settings_custom_meta_box", 10, 3);

function add_page_settings_custom_meta_box(){
	add_meta_box("banner-meta-box", "Inner Page Banner", "banner_page_settings_box_markup", array('page','post','news'), "normal", "high", null);
}

function banner_page_settings_box_markup($post){
	wp_nonce_field(basename(__FILE__), "page-settings-nonce");

	$banner_title = get_post_meta( $post->ID, '_banner_title', true );
	$banner_content = get_post_meta( $post->ID, '_banner_content', true );
	$histroy_image = get_post_meta( $post->ID, '_histroy_image', true );

	get_template_part('inc/upload-scripts');

	echo '<style type="text/css"> .page_settings_tbl td, .page_settings th{ padding: 7px 0px; } .page_settings textarea{ width: 25em;} </style>';
	echo '<table width="100%" class="page_settings" style="text-align: left;">';
		//echo get_admin_input('up_image', '_banner_image', 'Upload', $banner_image , '');

	echo get_admin_input('text', '_banner_title', 'Intro Title', $banner_title , '');
	echo get_admin_input('editor', '_banner_content', 'Intro Content', $banner_content , '');


	echo get_admin_input('up_image', '_histroy_image', 'Histroy image', $histroy_image , '');

	echo '</table>';
}

function save_page_settings_custom_meta_box( $post_id ) {

	if (!isset($_POST["page-settings-nonce"]) || !wp_verify_nonce($_POST["page-settings-nonce"], basename(__FILE__)))
        return $post_id;

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;

	if ( in_array($_POST['post_type'], array('page','post','cpt-conditions')) ) {

		if ( !current_user_can( 'edit_page', $post_id ) )
			return $post_id;

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	}

	$fields = array( '_banner_content','_banner_image','_banner_title','_histroy_image' );

	foreach( $fields as $field ) {
		if(isset($_POST[$field])){
			$value = ( $_POST[$field] );
			update_post_meta( $post_id, $field, $value );
		}
	}

}



add_action('add_meta_boxes', 'add_supplier_spotlight_meta');
function add_supplier_spotlight_meta()
{
	add_meta_box(
                'home_meta',
                'Home Page Post',
                'display_supplier_spotlight_meta',
                'cpt-news',
                'normal',
                'high');
}

function display_supplier_spotlight_meta() {
  global $post;
   wp_nonce_field( 'avt_homepage_meta_box', 'avt_homepage_meta_box_nonce' );


      $is_checked = (get_post_meta( $post->ID, '_popular', true )) ? 'checked="checked"' : '';
      ?>
      <p>
        <label for="avt_attroney_url">
            <strong><?php _e( 'Show in Hompage:', 'avt' ); ?></strong>
        </label>
        <input type="checkbox" name="_popular" <?php echo $is_checked; ?> value="1" />
      </p>
<?php    }

function avt_check_save_meta_box_data( $post_id ) {

      if ( ! isset( $_POST['avt_homepage_meta_box_nonce'] ) ) {
        return;
      }

      if ( ! wp_verify_nonce( $_POST['avt_homepage_meta_box_nonce'], 'avt_homepage_meta_box' ) ) {
        return;
      }

      if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
      }

      if ( isset( $_POST['post_type'] ) && 'cpt-news' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) ) {
          return;
        }

      } else {

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
          return;
        }
      }


		if ( isset( $_POST['_popular'] ) ) {
			$my_data = sanitize_text_field( $_POST['_popular'] );
		} else {
			$my_data = 0;
		}
	}





// Motorcycles images
add_action("add_meta_boxes", "add_page_settings_custom_meta_box_motorcycles");
add_action("save_post", "save_page_settings_custom_meta_box_motorcycles", 10, 3);

function add_page_settings_custom_meta_box_motorcycles(){
	add_meta_box("bannerds-meta-box", "Options", "banner_page_settings_box_markup_motorcycles", array('concierge'), "normal", "high", null);
}


function banner_page_settings_box_markup_motorcycles($post){
	wp_nonce_field(basename(__FILE__), "page-settings-nonce");


	$linkUrl = get_post_meta( $post->ID, 'rd_link', true );
	$buttonText = get_post_meta( $post->ID, 'rd_btn', true );
	$cImage = get_post_meta( $post->ID, 'c_image', true );

	get_template_part('inc/upload-scripts');

	echo '<style type="text/css"> .page_settings_tbl td, .page_settings th{ padding: 7px 0px; } .page_settings textarea{ width: 25em;} </style>';
	echo '<table width="100%" class="page_settings" style="text-align: left;">';

	echo get_admin_input('text', 'rd_link', 'Link Url', $linkUrl , '');

	echo get_admin_input('text', 'rd_btn', 'Button text', $buttonText , '');

	echo get_admin_input('up_image', 'c_image', 'Image', $cImage , '');


	echo '</table>';
}

function save_page_settings_custom_meta_box_motorcycles( $post_id ) {

	if (!isset($_POST["page-settings-nonce"]) || !wp_verify_nonce($_POST["page-settings-nonce"], basename(__FILE__)))
        return $post_id;

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;

	if ( in_array($_POST['post_type'], array('concierge')) ) {

		if ( !current_user_can( 'edit_page', $post_id ) )
			return $post_id;

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	}

	$fields = array('rd_link','rd_btn','c_image');

	foreach( $fields as $field ) {
		if(isset($_POST[$field])){
			$value = ( $_POST[$field] );
			update_post_meta( $post_id, $field, $value );
		}
	}

}
 ?>
