<?php
/*
Template Name: Contact Us
*/
if(isset($_POST['submitted'])) {
		if(trim($_POST['formname']) === '') {
			$nameError = 'Please enter your name.';
			$hasError = true;
		} else {
			$formname = trim($_POST['formname']);
		}		
		
		if(trim($_POST['email']) === '')  {
			$emailError = 'Please enter your e-mail address.';
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = 'You entered an invalid e-mail address.';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}				
		
		if(trim($_POST['message']) === '') {
			$msgError = 'Please enter a message.';
			$hasError = true;
		} else {
			$message = trim($_POST['message']);
		}		
		
		$company = trim($_POST['company']);
			
		if(!isset($hasError)) {
			$options = get_option('theme_options');
			$emailTo = $options['email_address'];
			if (!isset($emailTo) || ($emailTo == '') ){
				$emailTo = get_option('admin_email');
			}
			$subject = '[Keen - Contact Form] From '.$formname;
			$body = "This form was submitted from http://keenconsulting.ca/contact-us/. \n\nName: $formname \nEmail Address: $email \nCompany: $company \nMessage: \n$message \n";
			$headers = 'From: '.$formname.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);
			$emailSent = true;
		}
	
} ?>
<?php get_header(); ?>

<?php require_once ( get_template_directory() . '/includes/breadcrumbs.php' ); ?>

<?php $snav_args=array(
	//use these args to gather sub page details.
	'posts_per_page' => -1, 
	'child_of' => $first_parent->ID, 
	'post_type' => 'page',
	'sort_column' => 'menu_order', 
	'sort_order' => 'ASC',	
	'title_li' => '',
);
?>
<nav class="grid_3">&nbsp;</nav>

<article class="grid_9 article">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<header style="background-image:url(<?php echo get_field('header_image'); ?>); background-repeat:no-repeat; background-position:left top;">		
	</header>
	<div class="inner">
		<div class="left">
		<?php the_content(); ?>
		</div>
		<div class="right contact">			
			<h3>Contact Us Today</h3>
			<form action="<?php the_permalink(); ?>" id="contactForm" method="post">	
			<?php if(isset($emailSent) && $emailSent == true) : ?>
			<div class="thanks">
              <p class="thanks">Thank You, your e-mail was received and we will respond as soon as possible.</p>
            </div>
            <?php else : ?>
            <?php if(isset($hasError) || isset($captchaError)) { ?>
            <div style="padding:10px 10px 0">
	            <p class="error">Sorry, the following error(s) occurred:</p>	            
	            <ul class="error">
	              <?php if($nameError != '') { ?>
	              <li><?php echo $nameError; ?></li>
	              <?php } ?>
	              <?php if($emailError != '') { ?>
	              <li><?php echo $emailError; ?></li>
	              <?php } ?>
	              <?php if($msgError != '') { ?>
	              <li><?php echo $msgError; ?></li>
	              <?php } ?>
	            </ul>
            <?php } ?>
            <?php endif; ?>	
            
            	<label for="formname">Name <span>*</span></label>
            	<input name="formname" id="formname" type="text" value="<?php if(isset($_POST['formname'])) echo $_POST['formname'];?>" />
            	
            	<label for="email">E-mail <span>*</span></label>
            	<input name="email" id="email" type="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" />

            	
            	<label for="company">Company (Optional)</label>
            	<input name="company" id="company" type="text" value="<?php if(isset($_POST['company'])) echo $_POST['company'];?>" />
            	
            	<label for="message">Message <span>*</span></label>
            	<textarea name="message" rows="5" id="message"><?php if(isset($_POST['message'])) echo $_POST['message'];?></textarea>
            	
            	
            	<input type="hidden" name="submitted" id="submitted" value="true" />
            	<button type="submit" class="submit">Submit</button>
            	
			</form>
		</div>
	</div>
<?php endwhile; endif; ?>
</article>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
