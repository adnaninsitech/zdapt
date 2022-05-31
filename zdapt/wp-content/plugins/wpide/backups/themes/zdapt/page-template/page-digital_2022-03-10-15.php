<?php /* start WPide restore code */
                                    if ($_POST["restorewpnonce"] === "016ffb83721b25f471cd5d98ebce3aec96aa2efd9b"){
                                        if ( file_put_contents ( "/home/creapkxk/insitechstaging.com/demo/zdapt/wp-content/themes/zdapt/page-template/page-digital.php" ,  preg_replace("#<\?php /\* start WPide(.*)end WPide restore code \*/ \?>#s", "", file_get_contents("/home/creapkxk/insitechstaging.com/demo/zdapt/wp-content/plugins/wpide/backups/themes/zdapt/page-template/page-digital_2022-03-10-15.php") )  ) ){
                                            echo "Your file has been restored, overwritting the recently edited file! \n\n The active editor still contains the broken or unwanted code. If you no longer need that content then close the tab and start fresh with the restored file.";
                                        }
                                    }else{
                                        echo "-1";
                                    }
                                    die();
                            /* end WPide restore code */ ?><?php
/**
 * Template Name: Digital transformation Template
 */

get_header(); ?>
</div>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<section class="main-cloud">
    <div class="container">
        <div class="row">
                <div class="col-md-6 wow fadeInLeft" data-wow-duration="2s">
                  <h2><?php the_title(); ?></h2>
            <?php wpautop(the_content()); ?>
            </div>
            <div class="col-md-6 text-right wow fadeInRight" data-wow-duration="2s">
                <img src="<?php the_post_thumbnail_url('full'); ?>">
            </div>
        </div>
    </div>
</section>

<section class="cloud-computing" style="padding-bottom : 6%;">
     <div class="container">
        <div class="row">
            <div class="col-md-12 wow bounceInDown" data-wow-duration="4s">
                <?php echo the_field('description', get_the_ID()); ?>
             <a href="<?php echo get_site_url(); ?>/contact-us" class="cibtn">Migrate to the Cloud</a>

            </div>
        </div>
    </div>
</section>


<section class="cloud-stack">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <h2 class="wow fadeInLeft" data-wow-duration="2s">Technology Stack</h2>
                <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/Color-Logos.jpg">
            <!--<div class="slid">
            <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/1-1.png">
            <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/2-1.png">
            <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/3-1.png">
            <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/4-1.png">
            <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/5.png">
            </div>-->
            
             <a href="<?php echo get_site_url(); ?>/contact-us" class="cibtn">Migrate to the Cloud</a>
            
            <h4  class="wow fadeInLeft" data-wow-duration="2s">Clients</h4>
             <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/c.jpg">
        </div>
      </div> 
    </div>
    
</section>

<?php endwhile; wp_reset_query(); ?>



<div class="main-wrapper">
<?php get_footer(); ?>