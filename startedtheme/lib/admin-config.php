<?php
//----------------------------------------------------------------------------------
				//	Add Theme Custom post type & Meta box & front list //
//----------------------------------------------------------------------------------

// CPT ///
include('post_type/custom_post.php');
include('post_type/cust_styles.php');

// Meta box //
include('meta_box/post_fields.php');
include('meta_box/category_fields.php');
// include('meta_box/meta_box_season.php');
// include('meta_box/sub_metabox.php');
// include('meta_box/meta-box.php');

/// front list ////
// include('front_list/contact_list.php');
// include('front_list/search_list.php');

//----------------------------------------------------------------------------------
					//	Extra fields  // 
//----------------------------------------------------------------------------------

include('inc/site_settings.php');
include('inc/additional_functions.php');
include('inc/file-upload.php');
include('inc/pagination.php');
include('inc/upload-scripts.php');


?>
