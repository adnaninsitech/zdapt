<?php
/**
 * Template Name: Devops Template
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
            <div class="col-md-6 text-right " data-wow-duration="2s">
                <img src="<?php the_post_thumbnail_url('full'); ?>">
            </div>
        </div>
        
    </div>
</section>

<section class="cloud-computing devopsmain">
    <div class="container">
        <div class="row">
            <div class="col-md-12" data-wow-duration="2s">
                <?php echo the_field('description', get_the_ID()); ?><?php edit_post_link('edit', '<p>', '</p>'); ?>
            </div>
        </div>
    </div>
</section>

<section class="devhelp" style="background-image:url(<?php bloginfo('template_directory'); ?>/images/d1.jpg);">
       <div class="container">
        <div class="row">
            <div class="col-md-12 " data-wow-duration="2s">
                <?php echo the_field('helped_companies', get_the_ID()); ?><?php edit_post_link('edit', '<p>', '</p>'); ?>
            </div>
        </div>
    </div>
</section>


<section class="main-cloud devaccord">
    <div class="container">
        
        <div class="row">
            <div class="col-md-6">
                      <ul>
                          
                <?php

// Check rows exists.
if( have_rows('accordion') ):

    // Loop through rows.
   $x=1; while( have_rows('accordion') ) : the_row();

        // Load sub field value.
        $title = get_sub_field('ttitle');
        $description = get_sub_field('description');
        // Do something...
        
        if($x<=2){
        ?>
            
      
                <li  data-wow-duration="2s">
                    <a href="javascript:;" class="clist" rel="<?php echo $x; ?>"><?php echo $title; ?><i class="fa fa-plus" id="fa<?php echo $x; ?>" aria-hidden="true"></i></a>
                    <div class="desc" id="descs<?php echo $x; ?>">
                        <?php echo $description; ?><?php edit_post_link('edit', '<p>', '</p>'); ?>
                    </div>
                </li>
        
        
        <?php
        }

    // End loop.
   $x++; endwhile;

// No value.
else :
    // Do something...
endif;
?>    </ul>
            </div>
            <div class="col-md-6">
                  <ul>
                          
                <?php

// Check rows exists.
if( have_rows('accordion') ):

    // Loop through rows.
   $x=1; while( have_rows('accordion') ) : the_row();

        // Load sub field value.
        $title = get_sub_field('ttitle');
        $description = get_sub_field('description');
        // Do something...
        
        if($x>2){
        ?>
            
      
                <li  data-wow-duration="2s">
                    <a href="javascript:;" class="clist" rel="<?php echo $x; ?>"><?php echo $title; ?><i class="fa fa-plus" id="fa<?php echo $x; ?>" aria-hidden="true"></i></a>
                    <div class="desc" id="descs<?php echo $x; ?>">
                        <?php echo $description; ?><?php edit_post_link('edit', '<p>', '</p>'); ?>
                    </div>
                </li>
        
        
        <?php
        }

    // End loop.
   $x++; endwhile;

// No value.
else :
    // Do something...
endif;
?>    </ul>
            </div>
        </div>
    </div>
</section>

<section class="cloud-stack">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <h2  data-wow-duration="2s">DevOps Stack</h2>
          <!--<img   data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/Color-Logos.jpg">-->
          <?php if( have_rows('slider') ): ?>
          
        <div class="slid">
            <?php while( have_rows('slider') ) : the_row(); ?>
            
            <img class=" fadeInDown" data-wow-duration="2s" src="<?php echo get_sub_field('img'); ?>">
            
            <?php endwhile; ?>
            <!--<img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/2-1.png">
            <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/3-1.png">
            <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/4-1.png">
            <img  class="wow fadeInDown" data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/5.png">-->
            </div>
            <?php endif; ?>
            
            <a href="<?php echo get_site_url(); ?>/contact-us" class="cibtn">Schedule a DevOps Consultation</a>
            
            <h4   data-wow-duration="2s">Clients</h4>
             <img data-wow-duration="2s" src="<?php echo get_site_url(); ?>/wp-content/uploads/2022/03/Clind-Logos.png">
        </div>
      </div> 
    </div>
    
</section>

<?php endwhile; wp_reset_query(); ?>


<div class="main-wrapper">
<?php get_footer(); ?>