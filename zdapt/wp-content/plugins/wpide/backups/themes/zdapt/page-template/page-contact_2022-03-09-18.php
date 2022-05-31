<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "016ffb83721b25f471cd5d98ebce3aec6e605636a0"){
                                        if ( file_put_contents ( "/home/creapkxk/insitechstaging.com/demo/zdapt/wp-content/themes/zdapt/page-template/page-contact.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/creapkxk/insitechstaging.com/demo/zdapt/wp-content/plugins/wpide/backups/themes/zdapt/page-template/page-contact_2022-03-09-18.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
/**
 * Template Name: Contact Template
 */

get_header(); ?>
</div>

<style>
    body { background-image : url(<?php bloginfo('template_directory'); ?>/images/bgc.png); background-size : 100% 100%;}
</style>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<section class="main-contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Get In Touch</h1>
                 <?php  echo do_shortcode('[contact-form-7 id="5" title="Contact form 1"]'); ?>
            </div>
            <div class="col-md-12">
                <iframe src='https://outlook.office365.com/owa/calendar/ZDAPT@zdapt.com/bookings/' width='100%' height='100%' scrolling='yes' style='border:0'></iframe>

            </div>
        </div>
    </div>
</section>
        
<?php endwhile; wp_reset_query(); ?>

<div class="main-wrapper">
<?php get_footer(); ?>