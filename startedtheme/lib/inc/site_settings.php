<?php

    // create custom plugin settings menu
    add_action('admin_menu', 'site_create_content');
	function site_create_content() {
		$themepage = add_theme_page('Site Settings', 'Site Settings', 'administrator','common-settings', 'site_settings_form');

		//call register settings function
		add_action( 'admin_init', 'register_site_settings' );
		add_action('admin_print_styles-' . $themepage, 'site_settings_admin_styles');
	}
	function register_site_settings(){


		$settings_val = array('address1', 'address2','fb_link','tw_link','insta_link','pinterest','api_endpoint','api_username','api_password','description','date','guests','currency','email','price','phone','secur_depo');


		foreach($settings_val as $set )
			register_setting( 'common-settings-group', $set );
	}

	function site_settings_admin_styles(){
		wp_enqueue_style('jquery-style', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
		wp_enqueue_style('farbtastic');
		wp_enqueue_style( 'wp-color-picker');
		wp_enqueue_style('thickbox');
		//wp_enqueue_script('jquery');
		wp_enqueue_script('media-upload');
		wp_enqueue_media();
	}

	function site_settings_form(){
		get_template_part('inc/upload-scripts');

?>
		<div class="wrap">
		<p style="text-align: center;"><a href="<?php echo site_url(); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/assets/admin/images/logo.png" style="text-align: center;height: 83px!important;"></a></p>
			<form class="site-setting-form" method="post" id="point-settings" name="common-settings" action="options.php">
				<?php settings_fields('common-settings-group');?>
					<div class="settings-container">
						<ul class='k2b-tabs'>
							<li><a href="#k2b-tab8"><span class="dashicons dashicons-welcome-widgets-menus"></span> Footer Section</a></li>
							<li><a href="#k2b-tab9"><span class="dashicons dashicons-welcome-widgets-menus"></span> API configuration</a></li>
							<li><a href="#k2b-tab10"><span class="dashicons dashicons-welcome-widgets-menus"></span> Payment link generation</a></li>
							<li><a href="#k2b-tab11"><span class="dashicons dashicons-welcome-widgets-menus"></span> Email Address</a></li>
							<li><a href="#k2b-tab12"><span class="dashicons dashicons-welcome-widgets-menus"></span>  Synched</a></li>


						</ul>
						<div class="set_tab">

    						<div id="k2b-tab8" class="tab-wrapper">
    							<h2>Footer Settings</h2>
      							<table class="form-table">
      								 <?php
      								echo get_admin_input('editor', 'address1', 'Address one', get_option('address1'), '');
      								echo get_admin_input('editor', 'address2', 'Address two', get_option('address2'), '');
      									?>
      							</table>
                  <h2>Social Links</h2>
      							<table class="form-table">
      								 <?php
      								echo get_admin_input('text', 'fb_link', 'Facebook', get_option('fb_link'), '');
      								echo get_admin_input('text', 'tw_link', 'Twitter', get_option('tw_link'), '');
				                      echo get_admin_input('text', 'insta_link', 'Instagram', get_option('insta_link'), '');
				                      echo get_admin_input('text', 'pinterest', 'Pinterest', get_option('pinterest'), '');
      									?>
      							</table>
    						</div>
						
							<div id="k2b-tab9" class="tab-wrapper">
							<h2>API</h2>
							<table class="form-table">
								 <?php  
								    echo get_admin_input('text', 'api_endpoint', 'API Endpoint', get_option('api_endpoint'), '');
								    echo get_admin_input('text', 'api_username', 'API Username', get_option('api_username'), '');
								    echo get_admin_input('text', 'api_password', 'API Password', get_option('api_password'), '');
								   
									?>
							</table>
						</div>
						<div id="k2b-tab10" class="tab-wrapper">
							<h2>Generate link</h2>

							<div class="notification"></div>

							<table class="form-table">
								 <?php
								 	echo get_admin_input('textarea', 'description', 'Description', get_option('description'), '','','description');
								 	echo get_admin_input('text', 'date', 'Date', get_option('date'), '','','date');
								    echo get_admin_input('text', 'guests', 'Guests', get_option('guests'), '','','guests');
								    echo get_admin_input('select', 'currency', 'Currency', get_option('currency'), '', array('EUROS'=>'euro','POUNDS'=>'pounds','USD'=>'usd'),'currency');
								    echo get_admin_input('text', 'email', 'Email', get_option('email'), '','','email');
								    echo get_admin_input('text', 'price', 'Price', get_option('price'), '','','price');
								    echo get_admin_input('text', 'phone', 'Phone', get_option('phone'), '','','phone');
								    echo get_admin_input('text', 'secur_depo', 'secur_depo', get_option('secur_depo'), '','','secur_depo');
								   
									?>
							</table>
							<p class="submit" style=" text-align: center;"><input type="submit" class="button-primary" id="payment-generate" value="<?php _e('Submit') ?>" name="submit-settings" /></p>
						</div>
						<div id="k2b-tab11" class="tab-wrapper">
							<h2>Email</h2>

							<div class="notification"></div>
							<table class="form-table">

                          <?php  
								    echo get_admin_input('text', 'private__admin', 'Private  Admin Email ', get_option('private_admin'), '');
								    
								    echo get_admin_input('text', 'private_custom', 'Private  Custom Email', get_option('private_custom'), '');
								   
									?>
							</table>
							<p class="submit" style=" text-align: center;"><input type="submit" class="button-primary" id="payment-generate" value="<?php _e('Submit') ?>" name="submit-settings" /></p>
						</div>
						<div id="k2b-tab12" class="tab-wrapper">
							<h2>Sync Links</h2>
							<?php 
								$post_sync_args = array(
									'numberposts' =>-1,
									'post_type' => 'news',
									'orderby' => 'menu_order',
									'order' => 'ASC',
									'post_status'=>"publish"
								);
								$post_sync_pages = get_posts($post_sync_args);

								$post_synch_arr = array();
								foreach ($post_sync_pages as $key => $post_sync_page){
									$post_typeapi=get_post_meta( $post_sync_page->ID, 'post_type_api', true );
									if($post_typeapi=='api_manu'){
										$post_synch_arr[$post_sync_page->post_name] = $post_sync_page->post_title;
									}
								}

								echo get_admin_input('select', 'sync_ext_post', 'Sync Extrenal', get_option('post_synched'), '', $post_synch_arr,'sync_ext_post');
							 ?>
							<p class="submit" style=" text-align: center;"><input type="submit" class="button-primary" id="sync_icals" value="<?php _e('Sync Icals') ?>" name="submit-settings" /></p>
						</div>

</div>



						</div>

						<br/>
					  	<p class="submit" style=" text-align: center;"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" name="submit-settings" /></p>
				</div><!-- settings-container -->
			</form>
		</div><!-- wrap -->
<?php }?>
