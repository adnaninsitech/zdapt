<?php
/**
 * Template Name: Digital transformation Template
 */

get_header(); ?>
</div>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<section class="main-cloud">
    <div class="container">
        <div class="row">
                <div class="col-md-6 " data-wow-duration="2s">
                  <h2><?php the_title(); ?></h2>
            <?php wpautop(the_content()); ?><?php edit_post_link('edit', '<p>', '</p>'); ?>
            </div>
            <div class="col-md-6 text-right" data-wow-duration="2s">
                <img src="<?php the_post_thumbnail_url('full'); ?>">
            </div>
        </div>
    </div>
</section>

<section class="cloud-computing" style="padding-bottom : 6%; background-image : url(<?php echo the_field('bg_banner'); ?>);">
     <div class="container">
        <div class="row">
            <div class="col-md-12" data-wow-duration="4s">
                <?php echo the_field('description', get_the_ID()); ?><?php edit_post_link('edit', '<p>', '</p>'); ?>
             <a href="<?php echo get_site_url(); ?>/contact-us" class="cibtn">Migrate to the Cloud</a>

            </div>
        </div>
    </div>
</section>


<section class="cloud-stack">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <h2  data-wow-duration="2s">Technology Stack</h2>
                <!--<img   data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/Color-Logos.jpg">-->
                
            <?php if( have_rows('slider') ): ?>
          
        <div class="slid">
            <?php while( have_rows('slider') ) : the_row(); ?>
            
            <img  data-wow-duration="2s" src="<?php echo get_sub_field('img'); ?>"><?php edit_post_link('edit', '<p>', '</p>'); ?>
            
            <?php endwhile; ?>
            <!--<img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/2-1.png">
            <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/3-1.png">
            <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/4-1.png">
            <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/5.png">-->
            </div>
            <?php endif; ?>
            
             <a href="<?php echo get_site_url(); ?>/contact-us" class="cibtn">Migrate to the Cloud</a>
            
            <h4  data-wow-duration="2s">Clients</h4>
             <img data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/Clind-Logos.png">
        </div>
      </div> 
    </div>
    
</section>

<?php endwhile; wp_reset_query(); ?>



<div class="main-wrapper">
<?php get_footer(); ?>