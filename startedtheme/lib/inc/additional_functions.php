<?php
if ( ! function_exists( 'pagination' ) ){
	function pagination(){

		global $wp_query;
		$big = 999999999; // need an unlikely integer
		$arg = array(
				'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages,
				'type' => 'plain',
				'prev_next'    => true,
				'prev_text'    => __('&#171;'),
				'next_text'    => __('&#187;'),
			);
		return '<div class="pagination">'.paginate_links( $arg ).'</div>';
	}
}

if (!function_exists('encode_value')){
	function encode_value($value=''){
		if($value != ''){
			return str_replace('=','',base64_encode($value));
		}
	}
}

if(!function_exists('decode_value')){
	function decode_value($value=''){
		if($value != ''){
			return base64_decode($value);
		}
	}
}
function custom_loginlogo() {
echo '<style type="text/css">
h1 a {background: url('.get_bloginfo('template_directory').'/assets/admin/images/Logo.svg) no-repeat center !important; display: block; height: 90px !important; width: auto !important; }
.login,html{ background: #150e20 url('.get_bloginfo('template_directory').'/assets/images/backgala-img.jpg) repeat-x !important; background-position: center bottom !important; }
</style>';
}
add_action('login_head', 'custom_loginlogo');




if (!function_exists('get_admin_input')) {
	function get_admin_input($type = 'text', $name = '', $label = 'Label', $value = '', $help_words = '', $other_values = '', $inp_id = ''){
		$help = ($help_words != '')?'<br/><span class="description">('.$help_words.')</span>':'';
		$ins = ($inp_id != '')?'id="'.$inp_id.'"':'';
		$return = '';
		switch ($type) {
			case "text":
				$return .= '<tr valign="top"><th scope="row"><label>'.$label.'</label>'.$help.'</th><td><input class="regular-text" type="text" '.$ins.' name="'.$name.'"  value="'.$value.'"/></td></tr>';
			break;
			case "textarea":
				$return .= '<tr valign="top"><th scope="row"><label>'.$label.'</label>'.$help.'</th><td><textarea class="regular-text" '.$ins.' name="'.$name.'" rows="5" cols="70" >'.$value.'</textarea></td></tr>';
			break;

			case "editor":
				ob_start();
				$settings = array('wpautop' => true, 'media_buttons' => true, 'textarea_name' => $name, 'textarea_rows' => 5, 'tinymce' => true, 'quicktags' => true, 'drag_drop_upload' => true);
				wp_editor( $value, $name, $settings );
				$editor_contents = ob_get_contents();
				ob_end_clean();
				$return .= '<tr valign="top"><th scope="row"><label>'.$label.'</label>'.$help.'</th><td>'.$editor_contents.'</td></tr>';
			break;

			case "up_image":
				$container = ($value != '')?'<br/><img src="'.$value.'" style="max-width:300px;max-height: 150px;" alt="" />':'';
				$return .= '<tr valign="top"><th scope="row"><label>'.$label.'</label>'.$help.'</th><td><div class="upload-image"><input class="regular-text up-image" readonly="readonly" '.$ins.' name="'.$name.'" id="'.$name.'" type="text" value="'.$value.'" /><input class="upload-button button button-secondary" type="button" rel="#'.$name.'" value="Upload" class="thickbox" /><input class="remove-button button button-secondary" type="button" value="Remove" /><div class="upload-image-container">'.$container.'</div><!-- upload-image-container --></div><!-- upload-image --></td></tr>';
			break;

			case "up_file":
				$container = ($value != '')?'<br/><a href="'.$value.'" target="_blank" title="Download" >Download File</a>':'';
				$return .= '<tr valign="top"><th scope="row"><label>'.$label.'</label>'.$help.'</th><td><div class="upload-file"><input class="regular-text up-file" readonly="readonly" '.$ins.' name="'.$name.'" type="text" value="'.$value.'"/><input class="file-upload-button" type="button" value="Upload" class="thickbox" /><input class="remove-file" type="button" value="Remove" /><div class="upload-file-container">'.$container.'</div></div>';
			break;

			case "color_picker":
				$return .= '<tr valign="top"><th scope="row"><label>'.$label.'</label>'.$help.'</th><td><input class="regular-text up-file" readonly="readonly" '.$ins.' name="'.$name.'" type="hidden" value="'.$value.'"/></td></tr>';
				$return .= '<script type="text/javascript">';
				$return .= ($inp_id != '')?'jQuery(document).ready(function() {jQuery("#'.$inp_id.'").wpColorPicker();});':'';
				$return .= '</script></td></tr>';
			break;

			case "date_picker":
				$return .= '<tr valign="top"><th scope="row"><label>'.$label.'</label>'.$help.'</th><td><input class="regular-text up-file" readonly="readonly" '.$ins.' name="'.$name.'" type="text" value="'.$value.'"/>';
				$return .= '<script type="text/javascript">';
				$return .= ($inp_id != '')?'jQuery(document).ready(function() {jQuery("#'.$inp_id.'").datepicker({dateFormat : "yy-mm-dd",yearRange: "c-10:c+10", changeMonth: true, changeYear: true, gotoCurrent: true, showOtherMonths: true, selectOtherMonths: true});});':'';
				$return .= '</script></td></tr>';
			break;

			case "select":
				$return .= '<tr valign="top"><th scope="row"><label>'.$label.'</label>'.$help.'</th><td>';
				$return .= '<select '.$ins.' name="'.$name.'">';
				$return .= '<option value="">Select</option>';
				if(!empty($other_values)){
					if(is_array($other_values)){
						foreach($other_values as $select_lebel => $select_value){
							$return .= '<option value="'.$select_value.'" '.(($select_value == $value)?'selected="selected"':'').'>'.$select_lebel.'</option>';
						}
					}elseif($other_values == 'cat_sliders'){
						$cat_args = array('type' => 'post','orderby' => 'name','order' => 'ASC','hide_empty' => 1,'hierarchical' => 1,'exclude' => '','taxonomy' => 'slider-cat','pad_counts' => false );
						$categories = get_categories( $cat_args );
						if(!empty($categories)){
							foreach($categories as $cat){
								$return .= '<option value="'.$cat->slug.'" '.(($cat->slug == $value)?'selected="selected"':'').'>'.$cat->name.'</option>';
							}
						}
					}

				}else{
					$page_args = array('post_type' => 'page', 'numberposts' => -1);
					$pages = get_posts($page_args);
					if(!empty($pages)){
						foreach($pages as $pg){
							$return .= '<option value="'.$pg->ID.'" '.(($pg->ID == $value)?'selected="selected"':'').'>'.$pg->post_title.'</option>';
						}
					}
				}
				$return .= '</select></td></tr>';
			break;

			case "radio":
				$return .= '<tr valign="top"><th scope="row"><label>'.$label.'</label>'.$help.'</th><td>';

				if(!empty($other_values)){
					if(is_array($other_values)){
						$i = 1;
						foreach($other_values as $select_lebel => $select_value){
							$checked = '';
							if($select_value == $value){
								$checked = 'checked="checked"';
							}elseif($i == 1){
								$checked = 'checked="checked"';
							}
							$return .= '<label for="rdo_'.$name.'_'.$i.'">'.$select_lebel.'</label>';
							$return .= '<input id="rdo_'.$name.'_'.$i.'" type="radio" name="'.$name.'" '.$checked.' value="'.$select_value.'">';
							$i++;
						}
					}
				}
				$return .= '</td></tr>';
			break;

			case "checkbox":
				$return .= '<tr valign="top"><th scope="row"><label>'.$label.'</label>'.$help.'</th><td>';

				if(!empty($other_values)){
					if(is_array($other_values)){
						//print_r($other_values);
						//echo $name;
						$i = 1;
						foreach($other_values as $select_lebel => $select_value){
							$checked = '';
							if(is_array($value)){
								if(in_array($select_value,$value)){
									$checked = 'checked="checked"';
								}
							}

							$return .= ($i%4 == 1)?'<div class="check_box_seperator">':'';
								$return .= '<div class="check_box_container">';
								$return .= '<input id="chk_'.$name.'_'.$i.'" type="checkbox" name="'.$name.'[]" '.$checked.' value="'.$select_value.'">';
								$return .= '<span for="chk_'.$name.'_'.$i.'">'.$select_lebel.'</span>&nbsp;';
								$return .= '</div>';
							$return .= ($i%4 == 0)?'</div><!-- check_box_seperator -->':'';

							//echo $value;
							$i++;
						}
						$return .= ($i!= 1)?'</div><!-- check_box_seperator -->':'';
					}
				}else{
					$checked = ($value == 1)?'checked="checked"':'';
					//$return .= '<label for="chk_'.$name.'">'.$select_lebel.'</label>';
					$return .= '<input id="chk_'.$name.'" type="checkbox" name="'.$name.'" '.$checked.' value="1">';
				}
				$return .= '</td></tr>';
			break;

			default:
				$return .= '<tr valign="top"><th scope="row"><label>'.$label.'</label>'.$help.'</th><td><input class="regular-text" type="text" name="'.$name.'"  value="'.$value.'"/></td></tr>';
			break;
		}
		return $return;
	}
}

if ( ! function_exists( 'truncatebywords' ) ){
	function truncatebywords($phrase, $max_words){
	   $phrase_array = explode(' ',$phrase);
	   if(count($phrase_array) > $max_words && $max_words > 0)
		  $phrase = implode(' ',array_slice($phrase_array, 0, $max_words)).' ...';
	   return $phrase;
	}
}

if ( ! function_exists( 'truncatebychars' ) ){
	function truncatebychars($chars, $limit){
		if(strlen($chars) <= $limit)
			return $chars;
		else
			return substr($chars,0,$limit).' ...';;
	}
}

if ( ! function_exists( 'remove_footer_admin' ) ){
	add_filter('admin_footer_text', 'remove_footer_admin'); //change admin footer text
	function remove_footer_admin() {
		$footer_copy = ( get_option('footer-copy') != '' ) ? str_replace( '{YEAR}', date('Y'), get_option('footer-copy') )  : "Copyright &copy; ". date('Y') ." ".get_bloginfo('name').". All Rights Reserved";
		echo $footer_copy;
	}
}

if ( ! function_exists( 'add_admin_css' ) ){
	add_filter('admin_footer', 'add_admin_css'); //change admin footer text
	function add_admin_css() {
		echo '<link href="'.get_bloginfo('template_directory').'/assets/admin/css/admin-style.css" rel="stylesheet" media="all"  />';
		echo '<script src="'.get_stylesheet_directory_uri().'/assets/admin/js/tab-function.js"></script>';

	}
}

if ( ! function_exists( 'wp_login_logo_url' ) ){
	function wp_login_logo_url() {
	  return site_url();
	}
	add_filter( 'login_headerurl', 'wp_login_logo_url', 10, 4 );
}

if ( ! function_exists( 'wp_login_logo_title' ) ){
	function wp_login_logo_title() {
	  return get_option('blogname');
	}
	add_filter( 'login_headertitle', 'wp_login_logo_title');
}

if ( ! function_exists( 'wp_css_login' ) ){
	function wp_css_login(){
		echo '<link href="'.get_bloginfo('template_directory').'/assets/admin/css/wp-login.css" rel="stylesheet" media="all"  />';
	}
	add_action('login_head','wp_css_login');
}

if ( ! function_exists( 'set_fevicon' ) ){
	function set_fevicon(){
// 		$fav_icon = (get_option('fvicon') != '') ? get_option('fvicon') : get_bloginfo('stylesheet_directory').'/assets/images/favicon.ico';
// 		echo '<link rel="shortcut icon"  type="image/x-icon"/>';
	}
	add_action('login_head','set_fevicon');
	add_action('wp_head','set_fevicon');
	add_action('admin_head','set_fevicon');
}

if ( ! function_exists( 'my_function_admin_bar' ) ){
	function my_function_admin_bar(){ return false; }
	add_filter( 'show_admin_bar' , 'my_function_admin_bar');
}

if ( ! function_exists( 'generate_random_string' ) ){
	function generate_random_string(){
		$string = '';
		for ($i = 0; $i < 5; $i++) {
				$string .= chr(rand(97, 122));
		}
		$_SESSION['random_number'] = $string;
	}
}

if ( ! function_exists( 'hide_update_notice' ) ){
	function hide_update_notice() {
		remove_action( 'admin_notices', 'update_nag', 3 );
	}
	add_action( 'admin_notices', 'hide_update_notice', 1 );
}

if ( ! function_exists( 'my_footer_version' ) ){
	function my_footer_version() {
		return get_bloginfo('name');
	}

	add_filter( 'update_footer', 'my_footer_version', 11 );
}

if (!function_exists('generateRandomString')) {
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
}

/**
 * To display the breadcrumbs
 * <div class="bread-crumb">
											<ul class="clearfix">
												<li><a href="#">Home</a></li>
												<li><a href="#">Sub page</a></li>
											</ul>
									</div>
 */

if (!function_exists('site_breadcrumbs')) {
		function site_breadcrumbs(){

			/* === OPTIONS === */
			$text['home']     = 'Home'; // text for the 'Home' link
			$text['category'] = 'Archives for "%s"'; // text for a category page
			$text['search']   = 'Search results for "%s"'; // text for a search results page
			$text['tag']      = 'Tagged "%s"'; // text for a tag page
			$text['author']   = 'Archives for %s'; // text for an author page
			$text['404']      = 'Error 404'; // text for the 404 page

			$show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
			$show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
			$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
			$show_title     = 1; // 1 - show the title for the links, 0 - don't show
			//$delimiter      = '<span class="bc_delimiter"> / </span>'; // delimiter between crumbs
			$before         = '<li>'; // tag before the current crumb
			$after          = '</li>'; // tag after the current crumb
			/* === END OF OPTIONS === */

			global $post;
			$home_link    = home_url('/');
			$link_before  = '<li>';
			$link_after   = '</li>';
			$link_attr    = ' rel="v:url" property="v:title"';
			$link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
			$parent_id    = $parent_id_2 = 0;
			if(get_post_type() == 'cpt-news' ||  get_post_type() == 'page'){
				$parent_id  = $parent_id_2 = $post->post_parent;
			}
			$frontpage_id = get_option('page_on_front');

			if (is_front_page()) {

				if ($show_on_home == 1) echo '<a href="' . $home_link . '">' . $text['home'] . '</a>';

			} else {

				echo '<ul class="breadcrumbs">';
				if ($show_home_link == 1) {
					echo '<li><a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</li></a>';
					if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
				}
				if(is_home()){
					$blog_id = get_option('page_for_posts');
					echo $before . get_the_title($blog_id) . $after;
				} else if ( is_category() ) {
					$this_cat = get_category(get_query_var('cat'), false);
					if ($this_cat->parent != 0) {
						$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
						if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
						$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
						$cats = str_replace('</a>', '</a>' . $link_after, $cats);
						if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
						echo $cats;
					}
					if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

				} elseif ( is_search() ) {
					echo $before . sprintf($text['search'], get_search_query()) . $after;

				} elseif ( is_day() ) {
					echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
					echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
					echo $before . get_the_time('d') . $after;

				} elseif ( is_month() ) {
					echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
					echo $before . get_the_time('F') . $after;

				} elseif ( is_year() ) {
					echo $before . get_the_time('Y') . $after;

				} elseif ( is_single() && !is_attachment() ) {

					if ( get_post_type() != 'post' ) {
						$post_type = get_post_type_object(get_post_type());
						$slug = $post_type->rewrite;
						printf($link, $home_link  . $slug['slug'] . '/', $post_type->labels->name);
						//if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

						if ($parent_id) {
							$breadcrumbs = array();
							while ($parent_id) {
								$page = get_post($parent_id);
								if ($parent_id != $frontpage_id) {
									$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
								}
								$parent_id = $page->post_parent;
							}
							$breadcrumbs = array_reverse($breadcrumbs);
							//print_r($breadcrumbs);
							if( count($breadcrumbs) >=1 ){
								echo $delimiter;
							}
							for ($i = 0; $i < count($breadcrumbs); $i++) {
								echo $breadcrumbs[$i];
								if ($i != count($breadcrumbs)-1) echo $delimiter;
							}

							if ($show_current == 1) {
								if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id))
									echo $delimiter;

								echo $before . get_the_title() . $after;
							}
						} else {
							if ($show_current == 1) echo $delimiter.$before . get_the_title() . $after;
						}

					}else {
						$cat = get_the_category(); $cat = $cat[0];
						$cats = get_category_parents($cat, TRUE, $delimiter);
						if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
						$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
						$cats = str_replace('</a>', '</a>' . $link_after, $cats);
						if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
						echo $cats;
						if ($show_current == 1) echo $before . get_the_title() . $after;
					}

				} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
					$post_type = get_post_type_object(get_post_type());
					echo $before . $post_type->labels->singular_name . $after;

				} elseif ( is_attachment() ) {
					$parent = get_post($parent_id);
					$cat = get_the_category($parent->ID); $cat = $cat[0];
					if ($cat) {
						$cats = get_category_parents($cat, TRUE, $delimiter);
						$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
						$cats = str_replace('</a>', '</a>' . $link_after, $cats);
						if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
						echo $cats;
					}
					printf($link, get_permalink($parent), $parent->post_title);
					if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

				} elseif ( is_page() && !$parent_id ) {
					if ($show_current == 1) echo $before . get_the_title() . $after;

				} elseif ( is_page() && $parent_id ) {
					if ($parent_id != $frontpage_id) {
						$breadcrumbs = array();
						while ($parent_id) {
							$page = get_page($parent_id);
							if ($parent_id != $frontpage_id) {
								$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
							}
							$parent_id = $page->post_parent;
						}
						$breadcrumbs = array_reverse($breadcrumbs);
						for ($i = 0; $i < count($breadcrumbs); $i++) {
							echo $breadcrumbs[$i];
							if ($i != count($breadcrumbs)-1) echo $delimiter;
						}
					}
					if ($show_current == 1) {
						if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
						echo $before . get_the_title() . $after;
					}

				} elseif ( is_tag() ) {
					echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

				} elseif ( is_author() ) {
					global $author;
					$userdata = get_userdata($author);
					echo $before . sprintf($text['author'], $userdata->display_name) . $after;

				} elseif ( is_404() ) {
					echo $before . $text['404'] . $after;
				}

				if ( get_query_var('paged') ) {
					if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
					echo __('Page') . ' ' . get_query_var('paged');
					if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
				}

				echo '</ul>';

			}
	}
}
/**
 * Enables the Page Attributes meta box in Post edit screen.
 */
function page_attributes_support_for_posts() {
add_post_type_support( 'post', 'page-attributes' );
}
add_action( 'init', 'page_attributes_support_for_posts' );

/**
 * Orderby menu_order in home page
 */
function orderby_single_posts_home($query) {
  if ($query->is_home() && $query->is_main_query()) {
    $query->set('orderby', 'menu_order');
    $query->set('order', 'ASC');
  }
}

add_action('pre_get_posts', 'orderby_single_posts_home');


add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

 /*function language_selector_flags(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    if(!empty($languages)){

        foreach($languages as $l){
            if(!$l['active']) echo '<span><a href="'.$l['url'].'">';
            echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="22" />';
            if(!$l['active']) echo '</a></span>';

        }
    }
}*/
