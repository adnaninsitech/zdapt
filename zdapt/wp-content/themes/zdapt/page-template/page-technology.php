<?php
/**
 * Template Name: Technology Template
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
            <div class="col-md-6 text-right " data-wow-duration="2s">
                <img src="<?php the_post_thumbnail_url('full'); ?>">
            </div>
        </div>
        
    </div>
</section>


<section class="cloud-computing">
    <div class="container">
        <div class="row">
            <div class="col-md-12" data-wow-duration="2s">
                <?php echo the_field('description', get_the_ID()); ?><?php edit_post_link('edit', '<p>', '</p>'); ?>
            </div>
        </div>
    </div>
</section>

<section class="support-it" style="background-image : url(<?php bloginfo('template_directory'); ?>/images/t1.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-12 " data-wow-duration="2s">
                <?php echo the_field('supporting_it', get_the_ID()); ?><?php edit_post_link('edit', '<p>', '</p>'); ?>
            </div>
        </div>
    </div>
</section>

    <section class="home-help tech-list">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
       
                    <ul>
                    
                        <?php

// Check rows exists.
if( have_rows('list') ):

    // Loop through rows.
   $x=1; while( have_rows('list') ) : the_row();

        // Load sub field value.
        $icon = get_sub_field('icon');
        $title = get_sub_field('title');
        $description = get_sub_field('description');
        // Do something...
        ?>
        
          <li data-wow-duration="<?php echo $x; ?>s">
                            <a href="javascript:;" rel="<?php echo $x; ?>" class="liq"><img src="<?php echo $icon; ?>"><span><?php echo $title; ?><i class="fa fa-arrow-down" aria-hidden="true"></i></span></a>
                            <div class="desc" id="desc<?php echo $x; ?>">
                <?php echo $description; ?><?php edit_post_link('edit', '<p>', '</p>'); ?>
            </div>
                        </li>
                        
        
        <?php

    // End loop.
   $x++; endwhile;

// No value.
else :
    // Do something...
endif;
?>
                      
                        
                    
                    </ul>
                    
                     <a href="<?php echo get_site_url(); ?>/contact-us" class="cibtn">Talk to a Tech Consultant</a>
                </div>
            </div>
        </div>
    </section>


<section class="cloud-stack">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <h4   data-wow-duration="2s">Clients</h4>
             <img data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/Clind-Logos.png">
        </div>
      </div> 
    </div>
    
</section>

<?php endwhile; wp_reset_query(); ?>


<div class="main-wrapper">
<?php get_footer(); ?>