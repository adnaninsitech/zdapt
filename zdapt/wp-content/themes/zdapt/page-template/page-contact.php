<?php
/**
 * Template Name: Contact Template
 */

get_header(); ?>
</div>

<style>
    body { background-image : url(<?php bloginfo('template_directory'); ?>/images/bgc.png); background-size : 100% 100%;}
    section.header.darkHeader { display : none;}
</style>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<section class="main-contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Get In Touch</h1>
                </div>
                 <div class="col-md-9">
                 <?php  echo do_shortcode('[contact-form-7 id="5" title="Contact form 1"]'); ?>
                 
           <!--      <a href="https://outlook.office365.com/owa/calendar/ZDAPT@zdapt.com/bookings/" target="_blank" id="bbtn"><img src="<?php bloginfo('template_directory'); ?>/images/icon.png">Schedule a Quick 30 Mins Consultation Powered By MIcrosoft Bookings </a>
           --> </div>
           
           <div class="col-md-3">
               <div class="box">
                    <div>
                   <img src="<?php bloginfo('template_directory'); ?>/images/icon.png">
                   </div>
                   <p>Schedule a Quick 30 Mins Consultation</p>
                   <a href="https://outlook.office365.com/owa/calendar/ZDAPT@zdapt.com/bookings/" target="_blank">Book NOW </a>
                    <p>Powered By Microsoft Bookings </p>
               </div>
           </div>
            <!--<div class="col-md-12">
                <iframe src='https://outlook.office365.com/owa/calendar/ZDAPT@zdapt.com/bookings/' width='100%' height='100%' scrolling='yes' style='border:0'></iframe>

            </div>-->
        </div>
    </div>
</section>
        
<?php endwhile; wp_reset_query(); ?>

<div class="main-wrapper">
<?php get_footer(); ?>