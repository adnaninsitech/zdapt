<?php
/**
 * Template Name: Dedicated Team Template
 */

get_header(); ?>
</div>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<section class="main-cloud">
    <div class="container">
        <div class="row">
                <div class="col-md-6" data-wow-duration="2s">
                  <h2><?php the_title(); ?></h2>
            <?php wpautop(the_content()); ?><?php edit_post_link('edit', '<p>', '</p>'); ?>
            </div>
            <div class="col-md-6 text-right" data-wow-duration="2s">
                <img src="<?php the_post_thumbnail_url('full'); ?>">
            </div>
        </div>
    </div>
</section>

<section class="cloud-computing" style="padding-bottom : 6%; background-image : url(<?php echo the_field('bg_banner'); ?>);" >
     <div class="container">
        <div class="row">
            <div class="col-md-12 " data-wow-duration="4s">
                <?php echo the_field('description', get_the_ID()); ?><?php edit_post_link('edit', '<p>', '</p>'); ?>

            </div>
        </div>
    </div>
</section>

<!--<section class="cloud-computing" style="padding-bottom : 6%; background-image : url(<?php echo the_field('bg_banner_2'); ?>);" >
     <div class="container">
        <div class="row">
            <div class="col-md-12 " data-wow-duration="4s">
               
            </div>
        </div>
    </div>
</section>-->

<section class="cloud-computing" style="padding-bottom : 6%; background-image : url(<?php echo the_field('bg_banner_2'); ?>);" >
     <div class="container">
        <div class="row">
            <div class="col-md-12 " data-wow-duration="4s">
                <?php echo the_field('description_2', get_the_ID()); ?><?php edit_post_link('edit', '<p>', '</p>'); ?>

            </div>
        </div>
    </div>
</section>

<?php endwhile; wp_reset_query(); ?>



<div class="main-wrapper">
<?php get_footer(); ?>