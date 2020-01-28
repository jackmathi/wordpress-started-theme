<?php

/**********
Template Name: Contact
 **********/
get_header();

?>
<div class="render-blk">
	<div id="subPage" class="contactUs">

<!-- 		<div class="form-popup" id="thank" style="display: none;">
			<div class="form-content">
				<div class="container">
					<div class="row">
						<div class="col-8">
							<i class="close-popup la la-close"></i>
							<h1>Thank You</h1>
							<p>Thank You For Your Enquiry</p>

						</div>
					</div>
				</div>
			</div>
		</div> -->
		
		<?php $content = get_post_meta($post->ID, 'con_cont', true); ?>
		<!-- pop up start -->
		<div class="form-popup" id="contact_subp">
			<div class="form-content">
				<div class="container">
					<div class="row">
						<div class="col-8">
							<i class="close-popup la la-close"></i>
							<h1><?php echo $post->post_title; ?></h1>
							<p><?php echo do_shortcode($content); ?></p>
							<form name="contact_us_frm" id="contact_us_frm" class="contact_us_frm" method="post">


								<div class=" contact-card">
									<div class="formRow">
										<label class="floating-item" data-error="Please enter your name">
											<input type="text" name="firstname" id="first-name" class="floating-item-input input-item validate" value="" autocomplete="off" maxlength="15" onkeypress="return onlyAlphabets(event, this)" />
											<span class="floating-item-label">Name</span>
										</label>
									</div>
									<div class="formRow">
										<label class="floating-item" data-error="Please enter your phone number">
											<input type="text" name="telephone" id="telephone" class="floating-item-input input-item validate" value="" onkeypress="return isNumber(event)" maxlength="10" />
											<span class="floating-item-label">Phone</span>
										</label>
									</div>
									<div class="formRow">
										<label class="floating-item" data-error="Please enter your email address" data-error-valid="Please enter a valid email address">
											<input type="email" name="useremail" id="email" class="floating-item-input input-item validate" value="" />
											<span class="floating-item-label">Email</span>
										</label>
										<!-- <div class="notvalid-error-message">Please enter a valid email address</div> -->
									</div>
									<div class="formRow">
										<label class="floating-item" data-error="Please enter your city">
											<input type="text" name="city" id="city" class="floating-item-input input-item validate" value="" autocomplete="off" maxlength="75" onkeypress="return onlyAlphabets(event, this)" />
											<span class="floating-item-label">City</span>
										</label>
									</div>
									<div class="formRow message-row">
										<label class="floating-item" data-error="Please enter your message">
											<textarea class="floating-item-input input-item validate" name="message" id="message" rows="7"></textarea>
											<span class="floating-item-label">Message</span>
										</label>
									</div>
									<button class="button button-secondary" type="submit" id="con-submit">Submit<i class="la la-arrow-right"></i></button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- pop up end -->
		<?php get_header('sub');
		?>

		<section>
			<div class="container">
				<div class="row">
					<div class="col-8">
						<div class="breadCrumb clearfix">
							<!--removed 'desktop' class-->
							<ul>
								<li>
									<a rel="v:url" property="v:title" title="Brakes India." href="http://brakes.madebyfire.com/" class="home">Home</a>
								</li>
<!-- 								<li><?php echo $post->post_title; ?></li> -->
							</ul>
						</div>
						<h1><?php echo $post->post_title; ?></h1>
						<p><?php echo do_shortcode($content); ?></p>
					</div>
				</div>
				<?php echo apply_filters('the_content', $post->post_content); ?>
			</div>
		</section>


		<!-- <section>
			<div class="container">
				<div class="breadCrumb clearfix"> -->
		<!--removed 'desktop' class-->
		<!--	<ul>
						<li>
							<a rel="v:url" property="v:title" title="Brakes India." href="http://brakes.madebyfire.com/" class="home">Home</a>
						</li>
						<li><?php //echo $post->post_title; 
							?></li>
					</ul>
				</div>
				<h1><?php //echo $post->post_title; 
					?></h1>
				<div class="row">
					<div class="col-8">
						<p><?php // echo $content; 
							?></p>
					</div>
					<!-- <div class="col-4">
						<button class="button button-primary fR contact-form"> Contact Us <i class="la la-arrow-right"></i></button>
					</div> -->
		<!--	</div>
				<?php //echo apply_filters('the_content', $post->post_content); 
				?>
			</div>
		</section> -->

	</div>
</div>
<!-- footer start here -->


<?php get_footer(); ?>
